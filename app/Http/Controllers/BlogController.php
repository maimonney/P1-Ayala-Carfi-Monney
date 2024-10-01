<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Mostrar la lista de blogs
    public function index()
    {
        $blogs = Blog::all(); 
        return view('blogs.vista', compact('blogs'));
    }

    // Blog por id
    public function vistaIndividualBlog($id)
    {
        $blog = Blog::findOrFail($id); 
        return view('blogs.show', compact('blog'));
    }
}
