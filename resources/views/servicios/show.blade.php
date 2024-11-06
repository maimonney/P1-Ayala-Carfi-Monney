@extends('layouts.main')

@section('title', 'Detalle del Servicio')

@section('content')

<div class="col-12">
    <!-- Nav -->
    <x-nav> </x-nav>
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="container">
        <div class="cont_vista">
            <div>
                <div class="row cont_row_vista">
                    <div class="col-md-4">
                        @if ($service->image && file_exists(public_path($service->image)))
                            <img src="{{ asset($service->image) }}" class="img-fluid" alt="{{ $service->title }}">
                        @elseif ($service->image && Storage::disk('public')->exists($service->image))
                            <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid"
                                alt="{{ $service->title }}">
                        @else
                            No se encontro la imagen.
                        @endif
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
            <form action="{{ route('reservar.servicio', $service->id) }}" method="POST">
                @csrf
                <button type="submit" class="button btn_lila">Reservar</button>
            </form>

        </div>
    </div>
    <!-- Footer -->
    <x-footer> </x-footer>
</div>
@endsection