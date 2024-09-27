@extends('layouts.main')

@section('title', 'Listado de Servicios')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Listado de Servicios</h1>
            <div class="mb-3 d-flex justify-content-center">
                <a href="{{ route('admin.services.create') }}"
                    class="text-decoration-none text-white bg-primary rounded p-2 px-3">Agregar Nuevo Servicio</a>
            </div>

            <table class="table table-bordered table-striped">
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
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                                @else
                                    No hay imagen
                                @endif
                            </td>
                            <td>{{ $service->title }}</td>
                            <td>{{ Str::limit($service->description, 50) }}</td>
                            <td>$ {{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->category }}</td>
                            <td>{{ $service->duration }} min</td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                    class="btn btn-secondary ms-2">Editar</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="post"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" onclick="return confirm('¿Está seguro de eliminar este servicio?')"
                                        class="btn btn-danger ms-2" value="Eliminar">
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