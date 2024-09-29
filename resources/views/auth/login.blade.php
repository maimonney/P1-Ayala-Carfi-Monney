@extends('layouts.main')

@section('title', 'Pagina de inicio')

@section('content')

<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav> </x-nav>

            <div class="cont_div_form mt-5">
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="cont_form_login">
                    @csrf
                    <div class="form_text">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email"  class="form-control" value="{{old ('email')}}">
                    </div>

                    <div class="form_text">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="button btn_celeste mt-3">Iniciar sesión</button>

                    <a href="{{ route('register') }}" class="button btn_rosa text-center mt-3">Crear</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<x-footer> </x-footer>
@endsection