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
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                    alt="{{ $service->title }}">
                            @else
                                No hay imagen
                            @endif
                        </td>
                        <td class="cont_titulo">{{ $service->title }}</td>
                        <td class="cont_des">{{ Str::limit($service->description, 150) }}</td>
                        <td>$ {{ number_format($service->price, 2) }}</td>
                        <td>{{ $service->category }}</td>
                        <td>{{ $service->duration }} min</td>
                        <td>
                            <div class="cont_btn_tab">
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                    class="button btn_celeste me-4">Editar</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="post"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" onclick="return confirm('¿Está seguro de eliminar este servicio?')"
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