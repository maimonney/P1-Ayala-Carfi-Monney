@extends('layouts.main')

@section('title', 'Listado de usuarios')

@section('content')

<div class="container">
   <div class="row">
        <div class="col-12">
            <h1 class="text-center">Listado de usuarios</h1>
            <div class="mb-3 d-flex justify-content-center">
                <a href="{{ route('admin.users.create') }}" class="text-decoration-none text-white bg-primary rounded p-2 px-3">Agregar Nuevo Usuario</a>
            </div>

            <table class="table table-bordered table-striped">
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
                    @foreach ($users as $user) <!-- Cambia $services a $users -->
                        <tr>
                            <td>{{ $user->id }}</td> 
                            <td>{{ $user->name }}</td> 
                            <td>{{ $user->email }}</td> 
                            <td>{{ $user->role }}</td> 
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary ms-2">Editar</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" onclick="return confirm('¿Está seguro de eliminar este usuario?')" class="btn btn-danger ms-2" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
