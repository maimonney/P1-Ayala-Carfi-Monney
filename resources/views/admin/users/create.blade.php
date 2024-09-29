@extends('layouts.main')

@section('title', 'Nuevo Usuario')

@section('content')
<div>
    <x-nav_admin></x-nav_admin>
    <div class="mt-5 cont_div_admin">
        <h1 class="mb-3">Agregar Nuevo Usuario</h1>

        @if ($errors->any())
            <div class="alert_error">
                Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="cont_form_admin">
            @csrf

            <div class="form_admin">
                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Nombre</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ROL -->
                    <div class="mb-3 select_form">
                        <label for="role" class="form-label">Rol</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Seleccione un rol</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONFIRMAR CONTRASEÑA -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>

            <button type="submit" class="button btn_celeste">Agregar Usuario</button>
        </form>
    </div>

    <x-footer></x-footer>
</div>
@endsection
