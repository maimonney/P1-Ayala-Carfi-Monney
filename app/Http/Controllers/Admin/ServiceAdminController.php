<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceAdminController extends Controller
{
    // Listar todos los servicios en la vista de administración
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // Mostrar formulario para crear un nuevo servicio
    public function create()
    {
        return view('admin.services.create');
    }

    // Almacenar un nuevo servicio en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer',
            'category' => 'required|string',
        ], [
            'title.required' => 'El título es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'category.required' => 'La categoría es obligatoria.',
            'duration.integer' => 'La duración debe ser un número entero.',
        ]);

        // Manejo de la imagen
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img/servicio', 'public');
        }

        // Crear un nuevo servicio
        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'duration' => $request->duration,
            'category' => $request->category,
        ]);

        // Redirigir a la lista de servicios con un mensaje de éxito
        return redirect()->route('admin.services.index')->with('success', 'Servicio creado con éxito.');
    }

    // Mostrar todos los servicios en la vista pública (opcional)
    public function show()
    {
        $services = Service::all();
        return view('servicios.vista', compact('services'));
    }

    // Mostrar un servicio específico por su ID en la vista pública (opcional)
    public function vistaIndividual($id)
    {
        $service = Service::findOrFail($id);
        return view('servicios.show', compact('service'));
    }

    // Mostrar formulario para editar un servicio existente
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    // Actualizar un servicio existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos actualizados
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer',
            'category' => 'required|string',
        ]);

        $service = Service::findOrFail($id);

        // Manejo de la imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath = $request->file('image')->store('img/servicio', 'public');
        } else {
            $imagePath = $service->image;
        }

        // Actualizar los datos del servicio
        try {
            $service->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imagePath,
                'duration' => $request->duration,
                'category' => $request->category,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el servicio: ' . $e->getMessage());
        }

        // Redirigir a la lista de servicios con un mensaje de éxito
        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado con éxito.');
    }

    // Eliminar un servicio de la base de datos
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // Eliminar la imagen asociada si existe
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        // Eliminar el servicio
        $service->delete();

        // Redirigir a la lista de servicios con un mensaje de éxito
        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado con éxito.');
    }
}
