@extends('layouts.main')

@section('title', 'Detalle del Servicio')

@section('content')

<div class="col-12">
    <!-- Nav -->
    <x-nav> </x-nav>
    <div class="container">

        <div class="cont_vista">
            <div class="row cont_row_vista">
                <div class="col-md-4">


                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1>{{ $service->title }}</h1>
                    <p>{{ $service->description }}</p>

                    <p><strong>Precio:</strong> ${{ $service->price }}</p>

                    @if ($service->duration)
                        <p><strong>Duración:</strong> {{ $service->duration }} meses</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <!-- Footer -->
    <x-footer> </x-footer>
</div>
@endsection