@extends('layouts.main')

@section('title', 'Listado de Usuarios')

@section('content')

<div>
    <x-nav_admin></x-nav_admin>

    <div class="container mt-5">
        <h1 class="text-center">Listado de Usuarios</h1>
        <div class="mb-3 d-flex justify-content-center">
            <a href="{{ route('admin.users.create') }}" class="button btn_celeste">Agregar Nuevo Usuario</a>
        </div>

        <table class="table_cont">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <div class="cont_btn_tab">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="button btn_celeste me-4">Editar</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" onclick="return confirm('¿Está seguro de eliminar este usuario?')"
                                        class="button btn_rojo" value="Eliminar">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-footer></x-footer>
</div>

@endsection