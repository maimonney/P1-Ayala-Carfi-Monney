<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

// Rutas Públicas
Route::get('/', [HomeController::class, "home"])->name('home');
Route::get('/acerca-de', [HomeController::class, "about"])->name('about');
Route::get('/contacto', [HomeController::class, "contact"])->name('contact');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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

// Ruta pública para mostrar todos los servicios
Route::get('/servicios', [ServiceController::class, 'index'])->name('servicios.index');

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
Route::prefix('admin')->group(function () {
    // Ruta de índice para el panel de administración
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    // Rutas de servicios
    Route::resource('servicios', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
        'show' => 'admin.services.show',
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
});
