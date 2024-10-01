<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    // Mostrar todos los servicios
    public function index()
    {
        $services = Service::all();
        return view('servicios.vista', compact('services'));
    }

    // Mostrar un servicio individual
    public function vistaIndividual($id)
    {
        $service = Service::findOrFail($id);
        return view('servicios.show', compact('service'));
    }
}
