@extends('layouts.main')

@section('title', 'Detalle del Servicio')

@section('content')
<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <div class="container">
                <h1>{{ $service->title }}</h1>

                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid mb-3">

                <p>{{ $service->description }}</p>

                <p><strong>Precio:</strong> ${{ $service->price }}</p>

                @if ($service->duration)
                    <p><strong>Duración:</strong> {{ $service->duration }} minutos</p>
                @endif


            </div>
            <!-- Footer -->
            <x-footer> </x-footer>
        </div>
        @endsection