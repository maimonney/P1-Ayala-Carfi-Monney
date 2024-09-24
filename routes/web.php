<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, "home"])
    ->name('home');

Route::get('/acerca-de', [\App\Http\Controllers\HomeController::class, "about"])
    ->name('about');

Route::get('/contacto', [\App\Http\Controllers\HomeController::class, "contact"])
    ->name('contact');

Route::get('peliculas/listado', [App\Http\Controllers\MovieController::class, "index"])
    ->name('movies.index');

Route::get('peliculas/{id}', [App\Http\Controllers\MovieController::class, "view"])
    ->name('movies.view')
    ->whereNumber('id');

Route::get('peliculas/publicar', [App\Http\Controllers\MovieController::class, "creatForm"])
    ->name('movies.create.form');

Route::get('peliculas/{id}/editar', [App\Http\Controllers\MovieController::class, "editForm"])
    ->name('movies.edit.form')
    ->whereNumber('id');

Route::post('peliculas/{id}/editar', [App\Http\Controllers\MovieController::class, "editProcess"])
    ->name('movies.edit.process')
    ->whereNumber('id');

Route::post('peliculas/{id}/eliminar', [App\Http\Controllers\MovieController::class, "deleteProcess"])
    ->name('movies.delete.process')
    ->whereNumber('id');

Route::post('peliculas/publicar', [App\Http\Controllers\MovieController::class, "creatProcess"])
    ->name('movies.create.process');
