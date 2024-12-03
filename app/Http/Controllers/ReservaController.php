<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Service;
use App\Models\Users; 
use App\Mail\ReservaConfirmacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();
        return view('servicios.vista', compact('reservas'));
    }

    public function reservarServicio($serviceId)
{
    $user = Auth::user();

    if (!$user) {
        return back()->with('error', 'Usuario no autenticado.');
    }

    $service = Service::findOrFail($serviceId);

    $reserva = Reserva::create([
        'user_id' => $user->id,
        'service_id' => $service->id,
        'status' => 'pendiente',
    ]);

    Mail::to($user->email)->send(new ReservaConfirmacion($reserva));

    return redirect()->route('servicios.show', $serviceId)
                     ->with('success', 'Gracias por contratar el servicio. Se ha enviado una confirmación a tu correo.');
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
