@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav></x-nav>

            <div class="cont_div_form mt-5">
                @if ($errors->any())
                    <div class="alert_error">
                        Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
                    </div>
                @endif
                <h2>Crear nuevo Usuario</h2>
                <!-- Form -->
                <form method="POST" action="{{ route('register.submit') }}" class="cont_form_login">
                    @csrf
                    <div class="form_text">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form_text">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form_text">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form_text">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="button btn_verde mt-3">Crear cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<x-footer></x-footer>

@endsection
