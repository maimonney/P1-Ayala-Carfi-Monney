@extends('layouts.main')

@section('title', 'Listado de Blogs')

@section('content')

<div>
    <x-nav_admin></x-nav_admin>

    <div class="container_cuadro">
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

            @if (session('success'))
                <div class="alert_correcto">
                    {{ session('success') }}
                </div>
            @endif

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
                            <td style="width: 250px;">
                                @if ($blog->image && file_exists(public_path($blog->image)))
                                    <img src="{{ asset($blog->image) }}" class="img-fluid" alt="{{ $blog->title }}">
                                @elseif ($blog->image && Storage::disk('public')->exists($blog->image))
                                    <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid" alt="{{ $blog->title }}">
                                @else
                                    No se encontro la imagen.
                                @endif
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td style="width: 350px;">{{ $blog->description }}</td>
                            <td style="width: 350px;">{!! Str::limit($blog->content, 100) !!}</td>
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

                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button btn_rojo me-4">Eliminar</button>
                                    </form>



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