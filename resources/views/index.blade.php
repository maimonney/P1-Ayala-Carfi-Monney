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
                <div class="text-center cont_div cont_rosa d-flex align-items-center">
                    <img class="w-23" src="{{ asset('img/ilustracion_1.png') }}" alt="Ilustracion de diseño">
                        <div>
                        <h1 class="display-4">Bienvenido a Nova</h1>
                        <p class="lead">Ofrecemos los mejores servicios para satisfacer tus necesidades.</p>
                        <a class="btn btn_service btn-lg mt-4" href="{{ route('servicios.index') }}" role="button">Ver
                        Servicios</a>
                        </div>
                </div>

                <!-- Destacados -->
                <div>
                    <h2 class="mt-5">Nuestros Servicios Destacados</h2>
                    <div class="row">
                        <div class="card cont_div" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articulo Blog -->
                <div>
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
                <div class="cont_div cont_lila mt-5">
                    <h2 class="mt-5">¿Necesitas más información?</h2>
                    <p>Contáctanos para obtener un presupuesto personalizado o si tienes alguna consulta.</p>
                    <div>
                    <a class="btn btn_conocenos m-2" href="{{ route('about') }}" role="button">Conocenos</a>
                    <a class="btn btn_contacto m-2" href="{{ route('contact') }}" role="button">Contáctanos</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Nav -->
    <x-footer> </x-footer>
</div>


@endsection