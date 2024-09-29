@extends('layouts.main')

@section('title', 'Listado de Blogs')

@section('content')

<div>
    <x-nav_admin></x-nav_admin>

    <div class="container mt-5">
        <h1 class="text-center">Listado de Blogs</h1>
        <div class="mb-3 d-flex justify-content-center">
            <a href="{{ route('admin.blogs.create') }}" class="button btn_celeste">Agregar Nuevo Blog</a>
        </div>
        @if ($blogs->isEmpty())
            <div class="alert_error cont_error_admin">
                <img src="{{ asset('img/ilustracion_3.png') }}" alt="Ilustracion neobrutalista">
                <div>
                    <p>No hay blogs disponibles.</p>
                    <p><strong>¡Agrega uno nuevo!</strong></p>
                </div>
            </div>
        @else
            <table class="table_cont">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Contenido</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Tags</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog) 
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>
                                @if ($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                        style="width: 100px; height: auto;">
                                @else
                                    <p>No hay imagen disponible</p>
                                @endif
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->description }}</td>
                            <td>{{ Str::limit($blog->content, 100) }}</td>
                            <td>
                                @if($blog->author)
                                    {{ $blog->author->name }}
                                @else
                                    Desconocido
                                @endif
                            </td>
                            <td>{{ $blog->published_at ? date('d/m/Y', strtotime($blog->published_at)) : '' }}</td>
                            <td>{{ $blog->tags }}</td>
                            <td>
                                <div class="cont_btn_tab">
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                        class="button btn_celeste me-4">Editar</a>

                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="post"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="button" class="button btn_rojo" value="Eliminar" data-toggle="modal"
                                            data-target="#deleteModal"
                                            onclick="setDeleteFormAction('{{ route('admin.blogs.destroy', $blog->id) }}')">
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
                                                    ¿Está seguro de eliminar este blog?
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
    document.getElementById('deleteForm').addEventListener('submit', function (e) {
        console.log("Formulario enviado");
    });

</script>
@endsection