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
                <div class="text-center cont_div cont_rosa d-flex align-items-center mb_div mt-5">
                    <img class="w-23" src="{{ asset('img/ilustracion_1.png') }}" alt="Ilustracion de diseño">
                    <div>
                        <h1 class="display-4">Bienvenido a Nova</h1>
                        <p class="lead">Ofrecemos los mejores servicios de diseño y programación para satisfacer tus necesidades.</p>
                        <a class="button btn_lila m-2" href="{{ route('about') }}" role="button">Conocenos</a>
                    </div>
                </div>

                <!-- Destacados -->
                <div class="container mb_div">
                    <h2 class="mt-5 mb-4">Nuestros Servicios Destacados</h2>
                    <div class="row">
                        @foreach ($publicServices as $color => $service) 
                            <div class="col-12 col-md-6 col-xl-4 mb-3">
                                <div class="card h-100 {{ 'color-' . ($color % 3 + 1) }}">
                                    <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                        alt="{{ $service->title }}">
                                    <div class="card-body">
                                        <div>
                                            <h3>{{ $service->title }}</h3>
                                            <p>{{ \Illuminate\Support\Str::limit($service->description, 150) }}</p>
                                            <p class="card-text"><strong>Precio:</strong> ${{ $service->price }}</p>
                                        </div>
                                        <div class="button-container">
                                            <a href="{{ route('servicios.show', $service->id) }}"
                                                class="button btn_link">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="button btn_celeste mt-5" href="{{ route('servicios.vista') }}" role="button">Ver más servicios</a>

                </div>


                <!-- Articulo Blog -->
                <div class="mb_div">
                    <h2 class="mt-5">Últimos Artículos del Blog</h2>
                    <div class="row">
                        <div class="card cont_div">
                            <h5 class="ms-3 mt-3">Featured</h5>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contacto -->
                <div class="cont_div cont_lila mt-5 mb_div">
                    <h2 class="mt-5">¿Necesitas más información?</h2>
                    <p>Contáctanos para obtener un presupuesto personalizado o si tienes alguna consulta.</p>
                    <div>
                        <a class="button btn_rosa m-2" href="{{ route('about') }}" role="button">Conocenos</a>
                        <a class="button btn_celeste m-2" href="{{ route('contact') }}" role="button">Contáctanos</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer> </x-footer>
</div>


@endsection