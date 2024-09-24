@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <div class="container mt-5">
                <!-- Bienvenida -->
                <div class="text-center">
                    <h1 class="display-4">Bienvenido a Nova</h1>
                    <p class="lead">Ofrecemos los mejores servicios para satisfacer tus necesidades.</p>
                    <hr class="my-4">
                    <p>Explora nuestros servicios a continuación para saber más sobre lo que ofrecemos.</p>
                    <a class="btn btn-primary btn-lg" href="{{ route('services.index') }}" role="button">Ver
                        Servicios</a>
                </div>

                <!-- Destacados -->
                <div>
                    <h2 class="mt-5">Nuestros Servicios Destacados</h2>
                    <div class="row">

                    </div>
                </div>

                <!-- Articulo Blog -->
                <div>
                    <h2 class="mt-5">Últimos Artículos del Blog</h2>
                    <div class="row">
                    </div>
                </div>

                <!-- Contacto -->
                <div>
                    <h2 class="mt-5">¿Necesitas más información?</h2>
                    <p>Contáctanos para obtener un presupuesto personalizado o si tienes alguna consulta.</p>
                    <a class="btn btn-success" href="{{ route('about') }}" role="button">Conocenos</a>
                    <a class="btn btn-info" href="{{ route('contact') }}" role="button">Contáctanos</a>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection