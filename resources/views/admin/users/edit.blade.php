@extends('layouts.main')

@section('title', 'Editar Usuario')

@section('content')

    <div>
        <x-nav_admin></x-nav_admin>
        <div class="mt-5 cont_div_admin">
            <h1 class="mb-3">Editar Usuario</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en los datos del formulario. Por favor, revísalos y vuelve a intentar.
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="cont_form_admin">
                @csrf
                @method('PUT')

                <div class="form_admin">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Dejar vacío si no deseas cambiarla">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Confirma tu nueva contraseña">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuario
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sección para editar las reservas -->
                        <h3 class="mt-4">Reservas</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Servicio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservas as $reserva)
                                    <tr>
                                        <td>{{ $reserva->name }}</td>
                                        <td>
                                            <select name="reservas[{{ $reserva->pivot->service_id }}]" class="form-control">
                                                <option value="pendiente" {{ $reserva->pivot->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="completada" {{ $reserva->pivot->status == 'completada' ? 'selected' : '' }}>Completada</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="submit" class="button btn_celeste">Actualizar Usuario</button>
            </form>
        </div>

        <x-footer></x-footer>
    </div>

@endsection
