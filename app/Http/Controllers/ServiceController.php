<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Mostrar una lista de servicios
    public function index()
    {
        $services = Service::all(); // O el método que estés utilizando para obtener los servicios
        return view('service.index', compact('services'));
    }

    // Mostrar un formulario para crear un nuevo servicio
    public function create()
    {
        return view('admin.services.create');
    }

    // Almacenar un nuevo servicio
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Crear nuevo servicio
        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Servicio creado con éxito.');
    }

    // Mostrar un servicio específico
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    // Mostrar un formulario para editar un servicio
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Actualizar un servicio específico
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado con éxito.');
    }

    // Eliminar un servicio
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado exitosamente.');
    }

}

