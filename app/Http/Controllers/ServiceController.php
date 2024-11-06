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

    
}
