@extends('layouts.main')

@section('title', 'Mensaje Enviado')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <!-- Contenido -->
            <div class="container">
                <h1 class="mt-5">¡Mensaje Enviado!</h1>
                <p>Gracias por contactarnos. Nos pondremos en contacto contigo lo antes posible.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Volver a la Página Principal</a>
            </div>
        </div>

        @endsection