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
                <div class="cont_div cont_rosa cont_sobrenos_ros mb-5">
                <img src="{{ asset('img/ilustracion_6.png') }}" alt="Ilustracion Neobrutalista">
                    <div class="ms-5">
                    <h1 class="mt-5">Acerca de Nosotros</h1>
                    <p class="lead">En Nova, nos dedicamos a ofrecer los mejores servicios para satisfacer tus
                        necesidades.
                    </p>
                    </div>
                </div>

                <div class="cont_VM mt-5 mb-5">
                    <div class="cont_div cont_verde cont_sobrenos">
                        <img src="{{ asset('img/ilustracion_5.png') }}" alt="Ilustracion Neobrutalista">
                        <div>
                            <h2>Nuestra Misión</h2>
                            <p>Proporcionar soluciones de alta calidad en desarrollo web, mantenimiento y SEO, ayudando
                                a
                                nuestros
                                clientes a alcanzar sus objetivos digitales.</p>
                        </div>
                    </div>
                    <div class="cont_div cont_amarillo cont_sobrenos">
                        <img src="{{ asset('img/ilustracion_4.png') }}" alt="Ilustracion Neobrutalista">
                        <div>
                            <h2>Nuestra Visión</h2>
                            <p>Ser líderes en el mercado de servicios digitales, reconocidos por la innovación y la
                                calidad de nuestro trabajo.</p>
                        </div>
                    </div>
                </div>

                <div class="cont_div cont_rojo cont_sobrenos_ros mt-5 mb-5">
                   <div>
                   <h2>¿Por qué elegirnos?</h2>
                    <ul>
                        <li><strong>Experiencia:</strong> Contamos con un equipo de profesionales altamente capacitados.</li>
                        <li><strong>Compromiso:</strong> Nos dedicamos a entender las necesidades de nuestros clientes y a brindarles
                            soluciones personalizadas.</li>
                        <li><strong>Soporte:</strong> Ofrecemos soporte continuo para asegurar la satisfacción de nuestros clientes.</li>
                    </ul>
                   </div>

                    <img src="{{ asset('img/ilustracion_7.png') }}" alt="Ilustracion Neobrutalista">
                </div>


                <div class="mt-5 text-center mb-5">
                    <h2>Nuestro Equipo</h2>
                    <p>Estamos compuestos por un grupo diverso de expertos en diferentes áreas del desarrollo digital.
                    </p>
                    <div class="cont_alumnas mt-5">

                    <div class="alumnas m-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/dayayalaa.jpg') }}" alt="Foto de Daiana Ayala">
                            </div>
                            <h3 class="card-title mt-3">Daiana Ayala</h3>
                            <p class="card-text">Diseñadora y programadora web</p>
                        </div>

                        <div class="alumnas m-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/Maimonney.jpg') }}" alt="Foto de Mailen Monney">
                            </div>
                            <h3 class="card-title mt-3">Mailen Monney</h3>
                            <p class="card-text">Diseñadora gráfica y programadora web</p>
                        </div>

                        <div class="alumnas m-4">
                            <div class="cont_img_integrantes">
                                <img src="{{ asset('img/sofi.jpeg') }}" alt="Foto de Sofia Carafi">
                            </div>
                            <h3 class="card-title mt-3">Sofia Carafi</h3>
                            <p class="card-text">Diseñadora gráfica y desarrolladora web</p>
                        </div>
                    </div>
                </div>

                <div class="cont_div cont_lila mt-5">
                    <h2>Contáctanos</h2>
                    <p>Si tienes alguna pregunta o deseas más información sobre nuestros servicios, no dudes en.</p>
                    <a class="button btn_celeste m-2" href="{{ route('contact') }}" role="button">Contáctanos</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <x-footer> </x-footer>
</div>


@endsection