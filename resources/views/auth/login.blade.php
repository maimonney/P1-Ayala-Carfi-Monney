@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <div class="container mt-5">
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required autofocus>
                    </div>

                    <div>
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit">Iniciar sesión</button>
                </form>
                <a href="{{ route('register') }}">Crear</a>
</div></div></div></div>
                @endsection