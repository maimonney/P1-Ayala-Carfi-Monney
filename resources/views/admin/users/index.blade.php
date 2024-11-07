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
        @if ($users->isEmpty())
            <div class="alert_error cont_error_admin">
                <img src="{{ asset('img/ilustracion_3.png') }}" alt="Ilustracion neobrutalista">
                <div>
                    <p>No hay usuarios disponibles.</p>
                    <p><strong>¡Agrega uno nuevo!</strong></p>
                </div>
            </div>
        @else
            <table class="table_cont">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Servico</th>
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
                            <td>
                                @if (!$user->reservas->isEmpty())
                                    <ul>
                                        @foreach ($user->reservas as $reserva)
                                            <li>
                                                {{ $reserva->service->title }} ({{ $reserva->status }})
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    Sin servicio
                                @endif

                            </td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <div class="cont_btn_tab">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="button btn_celeste me-4">Editar</a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post"
                                        style="display:inline;" data-toggle="modal" data-target="#deleteModal"
                                        onclick="setDeleteFormAction('{{ route('admin.users.destroy', $user->id) }}')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="button" class="button btn_rojo" value="Eliminar">
                                    </form>


                                    <!-- Modal de Confirmación -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="cont_div cont_modal">
                                                <div class="modal_header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                                    <button type="button" class="close_btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de eliminar este servicio?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="button btn_lila"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="button btn_rojo" value="Eliminar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <x-footer></x-footer>
</div>

@endsection