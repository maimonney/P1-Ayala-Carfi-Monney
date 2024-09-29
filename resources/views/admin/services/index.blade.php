@extends('layouts.main')

@section('title', 'Listado de Servicios')

@section('content')
<div>
    <x-nav_admin></x-nav_admin>

    <div class="container_cuadro">
        <h1 class="text-center mt-5">Listado de Servicios</h1>
        <div class="mb-3 d-flex justify-content-center">
            <a href="{{ route('admin.services.create') }}" class="button btn_celeste">Agregar Nuevo Servicio</a>
        </div>
        @if ($services->isEmpty())
            <div class="alert_error cont_error_admin">
                <img src="{{ asset('img/ilustracion_3.png') }}" alt="Ilustracion neobrutalista">
                <div>
                    <p>No hay servicios disponibles.</p>
                    <p><strong>¡Agrega uno nuevo!</strong></p>
                </div>
            </div>
        @else
            <table class="table_cont">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Servicio</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Duración</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>
                                @if ($service->image)
                                <img src="{{ asset($service->image) }}" class="card-img-top"
                                        alt="{{ $service->title }}">
                                @else
                                    No hay imagen
                                @endif
                            </td>
                            <td class="cont_titulo">{{ $service->title }}</td>
                            <td class="cont_des">{{ Str::limit($service->description, 150) }}</td>
                            <td>$ {{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->category }}</td>
                            <td>{{ $service->duration }} meses</td>
                            <td>
                                <div class="cont_btn_tab">
                                    <a href="{{ route('admin.services.edit', $service->id) }}"
                                        class="button btn_celeste me-4">Editar</a>

                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="post"
                                        style="display:inline;" data-toggle="modal" data-target="#deleteModal"
                                        onclick="setDeleteFormAction('{{ route('admin.services.destroy', $service->id) }}')">
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
                                                    <button type="button" class="close_btn" data-dismiss="modal" aria-label="Close">
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

<script>
    function setDeleteFormAction(action) {
        document.getElementById('deleteForm').action = action;
    }
</script>
@endsection