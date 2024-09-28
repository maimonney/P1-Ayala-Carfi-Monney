@extends('layouts.main')

@section('title', 'Contáctanos')

@section('content')
<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <!-- Contenido -->
            <div class="cont_div_form mt-5 mb-5">

                <div>
                    <div class="cont_form">
                        <div class="d-flex">
                            <div>
                                <img class="img_contacto" src="{{ asset('img/ilustracion_2.png') }}"
                                    alt="Ilustracion sobre mails">
                            </div>
                            <div class="cont_info_form">
                                <h1 class="mt-4">Contáctanos</h1>
                                <p>Si tienes alguna pregunta o deseas más información sobre nuestros servicios, completa el formulario a continuación.</p>
                            </div>
                        </div>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <div class="button-container">
                            <button type="submit" class="button btn_link mt-5">Enviar</button>
                                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer> </x-footer>
        @endsection