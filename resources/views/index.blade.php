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
                <div class="cont_inicio cont_div cont_rosa mb_div">
                    <img class="img-fluid mb-3 mb-md-0" src="{{ asset('img/ilustracion_1.png') }}"
                        alt="Ilustracion de diseño">
                    <div>
                        <h1 class="display-4">Bienvenido a Nova</h1>
                        <p class="lead">Ofrecemos los mejores servicios de diseño y programación para satisfacer tus
                            necesidades.</p>
                        <a class="button btn_lila m-2" href="{{ route('about') }}" role="button">Conocenos</a>
                    </div>
                </div>


                <div class="container mb_div">
                    <h2 class="mt-5 mb-4">Nuestros Servicios Destacados</h2>
                    <div class="row">
                        @foreach ($publicServices as $color => $service)
                        <div class="col-12 col-md-6 col-xl-4 mb-3">
                                <div class="card h-100 {{ 'color-' . ($color % 3 + 1) }}">
                                    @if ($service->image && file_exists(public_path($service->image)))
                                        <img src="{{ asset($service->image) }}" class="card-img-top"
                                            alt="{{ $service->title }}">
                                    @elseif ($service->image && Storage::disk('public')->exists($service->image))
                                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                            alt="{{ $service->title }}">
                                    @else
                                        No se encontro la imagen.
                                    @endif
                                    <div class="card-body">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit($service->description, 150) }}</p>
                                        <p class="card-text"><strong>Precio:</strong> ${{ $service->price }}</p>
                                        <div class="button-container">
                                            <a href="{{ route('servicios.show', $service->id) }}"
                                                class="button btn_link">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="button btn_celeste mt-5" href="{{ route('servicios.vista') }}" role="button">Ver más
                        servicios</a>
                </div>


                <!-- Articulo Blog -->
                <div class="container mb_div">
                    <h2 class="mt-5 mb-4">Últimos Blogs</h2>
                    <div class="row justify-content-center">
                        @foreach ($blogs as $color => $blog)
                            <div class="col-12 col-md-6 col-xl-4 mb-3">
                                <div class="card h-100 {{ 'color-' . ($color % 3 + 1) }}">
                                    @if ($blog->image && file_exists(public_path($blog->image)))
                                        <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                                    @elseif ($blog->image && Storage::disk('public')->exists($blog->image))
                                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top"
                                            alt="{{ $blog->title }}">
                                    @else
                                        No se encontro la imagen.
                                    @endif
                                    <div class="card-body">
                                        <h3>{{ $blog->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit($blog->content, 150) }}</p>
                                        <div class="button-container">
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="button btn_link">Ver
                                                más</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="button btn_celeste mt-5" href="{{ route('blogs.vista') }}" role="button">Ver más
                        blogs</a>
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