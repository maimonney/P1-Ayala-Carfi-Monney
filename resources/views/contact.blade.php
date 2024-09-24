@extends('layouts.main')

@section('title', 'Contáctanos')

@section('content')
<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <!-- Contenido -->
            <div class="container">
                <h1 class="mt-5">Contáctanos</h1>
                <p>Si tienes alguna pregunta o deseas más información sobre nuestros servicios, completa el formulario a
                    continuación.</p>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
        @endsection