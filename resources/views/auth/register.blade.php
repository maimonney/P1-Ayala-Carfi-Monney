@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="container mt-5">
                <!-- Form -->
                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <div>
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div>
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div>
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div>
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit">Crear cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection