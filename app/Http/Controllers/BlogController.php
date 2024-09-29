<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlogController extends Controller
{
    // Mostrar la lista de blogs
    public function index()
    {
        $blogs = Blog::all(); 
        return view('admin.blogs.index', compact('blogs'));
    }

     // Blog por id
     public function vistaIndividualBlog($id)
     {
         $blog = Blog::findOrFail($id); 
         return view('blogs.show', compact('blog'));
     }

    // Mostrar el formulario para crear un nuevo blog
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Almacenar un nuevo blog en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|string',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de texto.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'content.required' => 'El contenido es obligatorio.',
            'content.string' => 'El contenido debe ser una cadena de texto.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'image.max' => 'La imagen no puede ser mayor de 2048 kilobytes.',
            'published_at.date' => 'La fecha de publicación debe ser una fecha válida.',
            'tags.string' => 'Las etiquetas deben ser una cadena de texto.',
        ]);

        // Asignar los campos necesarios para la creación del blog
        Blog::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'image' => $request->file('image') ? $request->file('image')->store('img-blog', 'public') : null,
            'tags' => $validated['tags'],
            'author_id' => auth()->user()->id,
            'published_at' => isset($validated['published_at']) ? Carbon::parse($validated['published_at']) : now(),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.blogs.index')->with('success', 'Blog creado exitosamente.');
    }

    // Mostrar un blog específico
    public function show()
{
    $blogs = Blog::all(); 
    return view('blogs.vista', compact('blogs'));
}

    // Mostrar el formulario para editar un blog
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Actualizar un blog en la base de datos
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|string',
        ]);
        
        // Manejo de img
        if ($request->hasFile('image')) {
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('img-blog', 'public');
        }

        // Actualizar los campos del blog
        $blog->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'published_at' => isset($validated['published_at']) ? Carbon::parse($validated['published_at']) : $blog->published_at,
            'tags' => $validated['tags'],
            'image' => $blog->image, // Mantiene el mismo valor si no hay nueva imagen
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog actualizado con éxito.');
    }

    // Eliminar un blog de la base de datos
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
    
        return redirect()->route('admin.blogs.index')->with('success', 'Blog eliminado con éxito.');
    }
    
    
}