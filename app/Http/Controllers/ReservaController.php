<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
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

        Reserva::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'status' => 'pendiente',
        ]);

        return redirect()->route('servicios.show', $serviceId)
                         ->with('success', 'Gracias por contratar el servicio');
    }
}
