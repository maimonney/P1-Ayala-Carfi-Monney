<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\AdminController;

// Rutas Públicas
Route::get('/', [HomeController::class, "home"])->name('home');
Route::get('/acerca-de', [HomeController::class, "about"])->name('about');
Route::get('/contacto', [HomeController::class, "contact"])->name('contact');
Route::get('/servicios', [ServiceController::class, 'show'])->name('servicios.vista');

// Vista de servicios
Route::get('/servicios', [ServiceController::class, 'index'])->name('servicios.vista');
Route::get('/servicios/{id}', [ServiceController::class, 'vistaIndividual'])->name('servicios.show');

// Vista de blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.vista');
Route::get('/blogs/{id}', [BlogController::class, 'vistaIndividualBlog'])->name('blogs.show');

// Ruta para enviar formulario de contacto
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    return redirect()->route('contact.sent');
})->name('contact.submit');

// Ruta para confirmación de envío
Route::get('/contact/sent', function () {
    return view('sent');
})->name('contact.sent');

// Rutas de registro y autenticación
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta de dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Rutas de administración

// Route::prefix('admin')->group(function () {
//     Route::get('/', function () {
//         if (!Auth::check() || Auth::user()->role !== 'admin') {
//             return redirect('/')->with('error', 'Acceso denegado');
//         }
//         return view('admin.index');
//     })->name('admin.index');

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/', function () {
//         return view('admin.index');
//     })->name('admin.index');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Rutas de servicios
    Route::resource('services', ServiceAdminController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    // Rutas de usuarios
    Route::resource('users', UsersController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Rutas de recursos para el blog
    Route::resource('blogs', BlogAdminController::class)->names([
        'index' => 'admin.blogs.index',
        'create' => 'admin.blogs.create',
        'store' => 'admin.blogs.store',
        'edit' => 'admin.blogs.edit',
        'update' => 'admin.blogs.update',
        'destroy' => 'admin.blogs.destroy',
        'show' => 'admin.blogs.show',
    ]);

});
