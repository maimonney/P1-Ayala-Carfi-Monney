<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Service;
use App\Models\Users;
use App\Mail\ReservaConfirmacion;
use App\Mail\ReservaConfirmacionOperador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Payment\MercadoPagoPayment;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();
        return view('servicios.vista', compact('reservas'));
    }

    public function reservarServicio($serviceId)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'Usuario no autenticado.');
        }

        // Obtener el servicio
        $service = Service::findOrFail($serviceId);

        // Crear la reserva en la base de datos
        $reserva = Reserva::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'status' => 'pendiente',
        ]);

        // Enviar correo de confirmación al usuario
        try {
            Mail::to($user->email)->send(new ReservaConfirmacion($reserva));
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo enviar el correo de confirmación: ' . $e->getMessage());
        }

        // Enviar correo de confirmación al operador
        try {
            Mail::to('mailen.monney@davinci.edu.ar')->send(new ReservaConfirmacionOperador($reserva));
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo enviar el correo de confirmación: ' . $e->getMessage());
        }

        // Crear la preferencia de pago en MercadoPago
        $mercadoPago = new MercadoPagoPayment();
        $item = [
            [
                'id' => $service->id,
                'title' => $service->title,
                'quantity' => 1,
                'unit_price' => floatval($service->price),
                'currency_id' => 'ARS',
            ]
        ];

        // dd($item);
        $mercadoPago->setItems($item);
        $mercadoPago->setBackUrls(
            route('mercadopago.success'),
            route('mercadopago.pending'),
            route('mercadopago.failure')
        );

        $preference = $mercadoPago->createPreference();

        return redirect($preference->init_point);
    }




    public function reservationProcess(int $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva || !$reserva->user) {
            return back()->with('error', 'No se encontró el usuario asociado a esta reserva.');
        }

        Mail::to($reserva->user->email)->send(new ReservaConfirmacion($reserva));

        return redirect()->route('admin.users.index')
            ->with('feedback.message', 'La reserva se realizó con éxito y se ha enviado un correo de confirmación.');
    }

    public function updateStatus(Request $request, $userId, $serviceId)
    {
        $user = Users::findOrFail($userId);
        $service = Service::findOrFail($serviceId);

        $user->services()->updateExistingPivot($service->id, ['status' => 'completada']);

        return response()->json([
            'message' => 'Estado de la reserva actualizado correctamente.',
        ]);
    }
}
