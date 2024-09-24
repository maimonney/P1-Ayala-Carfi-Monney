@extends('layouts.main')

@section('title', 'Nosotros')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>
            
            <!-- Contenido -->
            <div class="container">
                <h1 class="mt-5">Acerca de Nosotros</h1>
                <p class="lead">En Nova, nos dedicamos a ofrecer los mejores servicios para satisfacer tus necesidades.
                </p>

                <h2>Nuestra Misión</h2>
                <p>Proporcionar soluciones de alta calidad en desarrollo web, mantenimiento y SEO, ayudando a nuestros
                    clientes a alcanzar sus objetivos digitales.</p>

                <h2>Nuestra Visión</h2>
                <p>Ser líderes en el mercado de servicios digitales, reconocidos por la innovación y la calidad de
                    nuestro trabajo.</p>

                <h2>¿Por qué elegirnos?</h2>
                <ul>
                    <li>Experiencia: Contamos con un equipo de profesionales altamente capacitados.</li>
                    <li>Compromiso: Nos dedicamos a entender las necesidades de nuestros clientes y a brindarles
                        soluciones personalizadas.</li>
                    <li>Soporte: Ofrecemos soporte continuo para asegurar la satisfacción de nuestros clientes.</li>
                </ul>

                <h2>Nuestro Equipo</h2>
                <p>Estamos compuestos por un grupo diverso de expertos en diferentes áreas del desarrollo digital.</p>
                <div class="row mt-4">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="" alt="">
                                <h3 class="card-title">Daiana Ayala</h3>
                                <p class="card-text">Descripción breve del rol y experiencia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                            <img src="" alt="">
                                <h3 class="card-title">Mailen Monney</h3>
                                <p class="card-text">Descripción breve del rol y experiencia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                            <img src="" alt="">
                                <h3 class="card-title">Sofia Carafi</h3>
                                <p class="card-text">Descripción breve del rol y experiencia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h2>Contáctanos</h2>
                <p>Si tienes alguna pregunta o deseas más información sobre nuestros servicios, no dudes en <a
                        href="{{ route('contact') }}">contactarnos</a>.</p>
            </div>
        </div>
    </div>
</div>


@endsection