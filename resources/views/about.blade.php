@extends('layouts.main')

@section('title', 'Nosotros')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <!-- Contenido -->
            <div class="container mt-5">
                <div class="cont_div cont_rosa mb-5">
                    <h1 class="mt-5">Acerca de Nosotros</h1>
                    <p class="lead">En Nova, nos dedicamos a ofrecer los mejores servicios para satisfacer tus
                        necesidades.
                    </p>
                </div>

                <div class="cont_VM mt-5 mb-5">
                    <div class="cont_div cont_verde">
                        <h2>Nuestra Misión</h2>
                        <p>Proporcionar soluciones de alta calidad en desarrollo web, mantenimiento y SEO, ayudando a
                            nuestros
                            clientes a alcanzar sus objetivos digitales.</p>
                    </div>
                    <div class="cont_div cont_amarillo">
                        <h2>Nuestra Visión</h2>
                        <p>Ser líderes en el mercado de servicios digitales, reconocidos por la innovación y la calidad
                            de
                            nuestro trabajo.</p>
                    </div>
                </div>

                <div class="cont_div cont_rojo mt-5 mb-5">
                    <h2>¿Por qué elegirnos?</h2>
                    <ul>
                        <li>Experiencia: Contamos con un equipo de profesionales altamente capacitados.</li>
                        <li>Compromiso: Nos dedicamos a entender las necesidades de nuestros clientes y a brindarles
                            soluciones personalizadas.</li>
                        <li>Soporte: Ofrecemos soporte continuo para asegurar la satisfacción de nuestros clientes.</li>
                    </ul>
                </div>


                <div class="mt-5 text-center mb-5">
                    <h2>Nuestro Equipo</h2>
                    <p>Estamos compuestos por un grupo diverso de expertos en diferentes áreas del desarrollo digital.
                    </p>
                    <div class="row mt-5">

                        <div class="col-md-4 mb-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/dayayalaa.jpg') }}" alt="Foto de Daiana Ayala">
                            </div>
                            <h3 class="card-title mt-3">Daiana Ayala</h3>
                            <p class="card-text">Descripción breve del rol y experiencia.</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/Maimonney.jpg') }}" alt="Foto de Mailen Monney">
                            </div>
                            <h3 class="card-title mt-3">Mailen Monney</h3>
                            <p class="card-text">Descripción breve del rol y experiencia.</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/sofi.jpeg') }}" alt="Foto de Sofia Carafi">
                            </div>
                            <h3 class="card-title mt-3">Sofia Carafi</h3>
                            <p class="card-text">Descripción breve del rol y experiencia.</p>
                        </div>
                    </div>
                </div>

                <div class="cont_div cont_lila mt-5">
                    <h2>Contáctanos</h2>
                    <p>Si tienes alguna pregunta o deseas más información sobre nuestros servicios, no dudes en.</p>
                    <a class="btn btn_contacto m-2" href="{{ route('contact') }}" role="button">Contáctanos</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <x-footer> </x-footer>
</div>


@endsection