@extends('layouts.main')

@section('title', 'Servicios Disponibles')

@section('content')
<div class="container">
    <h1 class="mb-4">Servicios Disponibles</h1>

    <div>
                    <h2 class="mt-5">Nuestros Servicios Destacados</h2>
                    <div class="row">
                        @foreach($publicServices as $service)
                            <div class="col-md-4"> <!-- Ajusta el tamaño de columna según tu diseño -->
                                <div class="card cont_div" style="width: 18rem;">
                                    <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                        alt="{{ $service->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->title }}</h5>
                                        <p class="card-text">{{ $service->description }}</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Precio: {{ $service->price }} </li>
                                        <li class="list-group-item">An item</li>
                                        <!-- Modifica o elimina según sea necesario -->
                                        <li class="list-group-item">A second item</li>
                                    </ul>
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
</div>
@endsection
