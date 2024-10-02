<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller{
    public function index(){
        if(Auth::user()->role !=='admin'){
            return redirect('/')->with('error', 'No tiene acceso');
        }
        return view('admin.index');
    }
}
