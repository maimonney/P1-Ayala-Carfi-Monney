@extends('layouts.main')

@section('title', 'Perfil del Usuario')

@section('content') 
<!-- Nav -->
<x-nav> </x-nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card cont_div">
        <div class="row">
            <div class="col-md-4 text-center avatar">
            @if ($user->avatar)
    @if (file_exists(public_path($user->avatar)))
        <img src="{{ asset($user->avatar) }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="width: 150px; height: 150px; object-fit: cover;">
    @elseif (Storage::disk('public')->exists($user->avatar)) <!-- Corregido: Usamos elseif aquí -->
        <img src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="width: 150px; height: 150px; object-fit: cover;">
    @else
        <img src="/img/default-avatar.jpg" class="img-fluid rounded-circle" alt="Avatar por defecto" style="width: 150px; height: 150px; object-fit: cover;">
    @endif
@else
    <img src="/img/default-avatar.jpg" class="img-fluid rounded-circle" alt="Avatar por defecto" style="width: 150px; height: 150px; object-fit: cover;">
@endif



            </div>
            <div class="col-md-8">
                <div class="cont_navegacion">
                    <h2>{{ $user->name }}</h2>
                    <a href="{{ route('perfil.editar', $user->id) }}"><img src="/img/edit.png" alt="Boton editar"
                            class="btn_edit"></a>
                </div>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Miembro desde:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                <h3>Servicios contratados</h3>
                <div>
                    @if (!$user->reservas->isEmpty())
                        <ul>
                            @foreach ($user->reservas as $reserva)
                                <li>
                                    {{ $reserva->service->title }} ({{ $reserva->status }})
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a class="button btn_celeste mt-5" href="{{ route('servicios.vista') }}" role="button">Contratar un
                            servicio</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Footer -->
<x-footer> </x-footer>

@endsection