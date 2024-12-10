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
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, "home"])->name('home');
Route::get('/acerca-de', [HomeController::class, "about"])->name('about');
Route::get('/contacto', [HomeController::class, "contact"])->name('contact');

// servicios
Route::get('/servicios', [ServiceController::class, 'index'])->name('servicios.vista');
Route::get('/servicios/{id}', [ServiceController::class, 'vistaIndividual'])->name('servicios.show');
Route::post('/servicios/reservar/{serviceId}', [ReservaController::class, 'reservarServicio'])
    ->middleware('auth')
    ->name('reservar.servicio');

//blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.vista');
Route::get('/blogs/{id}', [BlogController::class, 'vistaIndividualBlog'])->name('blogs.show');

//formulario de contacto
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/contact/sent', function () {
    return view('sent');
})->name('contact.sent');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/perfil', [UsersController::class, 'perfil'])->name('perfil.user');
Route::get('/editarPerfil/{user}', [UsersController::class, 'editPerfil'])->name('perfil.editar');
Route::put('/editarPerfil/{user}', [UsersController::class, 'updatePerfil'])->name('perfil.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::put('/reservas/{userId}/{serviceId}/update-status', [ReservaController::class, 'updateStatus']);

//rutas de mercadopago
Route::get('pago/mercadopago', [MercadoPagoController::class, 'show'])
->name('pago.mercadopago.show');
Route::get('pago/mercadopago/v2', [MercadoPagoController::class, 'showV2'])
->name('pago.mercadopago.show.v2');
Route::get('test/mercadopago/success', [MercadoPagoController::class, 'successProcess'])
->name('test.mercadopago.successProcess');
Route::get('test/mercadopago/pending', [MercadoPagoController::class, 'pendingProcess'])
->name('test.mercadopago.pendingProcess');
Route::get('test/mercadopago/failure', [MercadoPagoController::class, 'failureProcess']);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

     // Ruta para el dashboard
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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
