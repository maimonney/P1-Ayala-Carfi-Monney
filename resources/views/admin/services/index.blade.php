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
                            <td style="width: 350px;">
                                @if ($service->image && file_exists(public_path($service->image)))
                                    <img src="{{ asset($service->image) }}" class="img-fluid" alt="{{ $service->title }}">
                                @elseif ($service->image && Storage::disk('public')->exists($service->image))
                                    <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid"
                                        alt="{{ $service->title }}">
                                @else
                                    No se encontro la imagen.
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

                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
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