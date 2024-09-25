@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav_admin> </x-nav_admin>

            <div class="container mt-5">
                <!-- Bienvenida -->
                <div>
                    <h1>Bienvenidos al Admin</h1>
                    <div>
                        <a href="{{ route('admin.services.index') }}">Servicios admin</a>
                        <a href="{{ route('admin.users.index') }}">Usuarios admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer> </x-footer>
</div>


@endsection