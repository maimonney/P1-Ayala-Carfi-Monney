@extends('layouts.main')

@section('title', 'Editar Perfil')

@section('content')
<div>
    <!-- Nav -->
    <x-nav></x-nav>
    <div class="mt-5 cont_div_admin">
        <h1 class="mb-3">Editar Perfil</h1>

        @if ($errors->any())
            <div class="alert_error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('perfil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Campo Nombre -->
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Avatar -->
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
                @error('avatar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <div class="cont_navegacion">
                <button type="submit" class="button btn_celeste mt-5">Actualizar Perfil</button>
                <a href="{{ route('perfil.user') }}" class="button btn_rojo mt-5">Cancelar</a>
            </div>
        </form>


    </div>
    <!-- Footer -->
    <x-footer> </x-footer>
</div>
@endsection