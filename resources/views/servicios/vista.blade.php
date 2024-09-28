@extends('layouts.main')

@section('title', 'Servicios Disponibles')

@section('content')
<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav></x-nav>

            <div class="container">
                <h1 class="mb-4">Servicios Disponibles</h1>

                <div>
                    <h2 class="mt-5">Nuestros Servicios Destacados</h2>
                    <div class="row">
                        @php
                            // Último servicio
                            $lastService = $services->last();
                        @endphp

                        @if ($lastService) <!-- Verificar si lastService no es null -->
                            <div class="col-12 mb-3">
                                <div class="card h-100 cont_div">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' . $lastService->image) }}" class="card-img-top w-60"
                                             alt="{{ $lastService->title }}">

                                        <div>
                                            <h5 class="card-title">{{ $lastService->title }}</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Precio: {{ $lastService->price }}</li>
                                                <li class="list-group-item">Duración: {{ $lastService->duration }}</li>
                                                <li class="list-group-item">Categoría: {{ $lastService->category }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $lastService->description }}</p>
                                    </div>
                                    <div class="button-container">
                                        <a href="{{ route('servicios.show', $lastService->id) }}"
                                           class="button btn_link">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>No hay servicios disponibles.</p> <!-- Mensaje si no hay servicios -->
                        @endif

                        <!-- Resto de servicios -->
                        @foreach($services as $service)
                            @if ($service != $lastService)
                                <div class="col-12 col-md-6 col-xl-4 mb-3">
                                    <div class="card h-100 cont_div" style="width: 18rem;">
                                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                             alt="{{ $service->title }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $service->title }}</h5>
                                            <p class="card-text">{{ $service->description }}</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Precio: {{ $service->price }}</li>
                                            <li class="list-group-item">Duración: {{ $service->duration }}</li>
                                            <li class="list-group-item">Categoría: {{ $service->category }}</li>
                                        </ul>
                                        <div class="button-container">
                                            <a href="{{ route('servicios.show', $service->id) }}" class="button btn_link">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
