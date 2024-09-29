<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // Formulario para crear un nuevo servicio
    public function create()
    {
        return view('admin.services.create');
    }

    // Nuevo servicio
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|nullable|integer',
            'category' => 'required|string',
        ], [
            'title.required' => 'El título es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'category.required' => 'La categoría es obligatoria.',
            'duration.required' => 'La duración es obligatoria.', 
            'duration.integer' => 'La duración debe ser un número entero.',
        ]);

        // Manejo de la imagen
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Cambia la ruta de almacenamiento a public/img/services_images
            $imagePath = $request->file('image')->store('img/services_images', 'public');
        }

        // Crear nuevo servicio
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

    // Todos los servicios
    public function show()
    {
        $services = Service::all();
        return view('servicios.vista', compact('services'));
    }

    // Servicio por id
    public function vistaIndividual($id)
    {
        $service = Service::findOrFail($id);
        return view('servicios.show', compact('service'));
    }

    // Formulario para editar un servicio
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    // Actualizar un servicio
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'duration' => 'nullable|integer',
        'category' => 'required|string'
    ]);

    $service = Service::findOrFail($id);

    // Manejo de la imagen
    if ($request->hasFile('image')) {
        // Eliminar la imagen antigua si existe
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        $imagePath = $request->file('image')->store('img/services_images', 'public');
    } else {
        $imagePath = $service->image; // Mantiene la imagen existente si no se carga una nueva
    }

    // Actualizar el servicio con los datos nuevos
    try {
        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Aquí asignamos la ruta de la imagen
            'duration' => $request->duration,
            'category' => $request->category,
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar el servicio: ' . $e->getMessage());
    }

    return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado con éxito.');
}



    // Eliminar un servicio
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado con éxito.');
    }

}
