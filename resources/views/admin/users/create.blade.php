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
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                     <!-- Avatar -->
                     <div class="mb-3 select_form">
                        <label for="avatar" class="form-label">Avatar</label>
                        <div id="avatarPreview" class="mt-2" style="display: none;">
                            <img id="preview" src="{{ asset('storage/'.$user->avatar) }}" alt="Previsualización de Avatar" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*" style="display: none;" onchange="previewAvatar(event)">
                        <button type="button" class="button btn_lila mt-4" onclick="document.getElementById('avatar').click();">
                            Seleccionar Avatar
                        </button>
                        @error('avatar')
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
