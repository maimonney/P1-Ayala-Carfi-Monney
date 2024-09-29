<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Service;

class HomeController extends Controller
{
    public function home()
{
    $publicServices = Service::latest()->take(3)->get(); 
    $blogs = Blog::latest()->take(3)->get();

    return view('index', compact('publicServices', 'blogs'));
}
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
