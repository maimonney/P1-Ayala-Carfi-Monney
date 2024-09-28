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

    // Ultimos 3 servicios
    public function home()
    {

        $publicServices = Service::latest()->take(3)->get();
        return view('index', compact('publicServices'));
    }

    // Mostrar un formulario para crear un nuevo servicio
    public function create()
    {
        return view('admin.services.create');
    }

    // Almacenar un nuevo servicio
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer',
            'category' => 'required|string'
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

    // Mostrar un servicio específico
    public function show()
    {
        $services = Service::all();
        return view('servicios.vista', compact('services'));
    }

    public function vistaIndividual($id)
    {
        $service = Service::findOrFail($id);
        return view('servicios.show', compact('service'));
    }

    // Mostrar un formulario para editar un servicio
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    // Actualizar un servicio específico
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
        // Encuentra el servicio por ID
        $service = Service::findOrFail($id);

        // Elimina el servicio
        $service->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado con éxito.');
    }

}
