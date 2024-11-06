<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('servicios.vista', compact('services'));
    }

    public function vistaIndividual($id)
    {
        $service = Service::findOrFail($id);
        return view('servicios.show', compact('service'));
    }

    public function reservarServicio($serviceId)
    {
        $user = Auth::user();
    
        $service = Service::findOrFail($serviceId);
    
        if (!$service || !$user) {
            return back()->with('error', 'El servicio o el usuario no existen.');
        }
    
        $user->services()->attach($serviceId, ['status' => 'pendiente']);
    
        return redirect()->route('detalle.servicio', $serviceId)
                         ->with('success', 'Gracias por contratar el servicio');
    }
    
}
