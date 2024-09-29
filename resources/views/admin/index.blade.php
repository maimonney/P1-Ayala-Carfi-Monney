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
                <div class="=cont_index_admin">
                    <h1 class="mb-5 text-center">Bienvenidos al Admin</h1>
                    <div class="cont_btn_admin">
                        <a href="{{ route('admin.services.index') }}" class="button btn_lila">Servicios</a>
                        <a href="{{ route('admin.users.index') }}" class="button btn_celeste">Usuarios</a>
                        <a href="{{ route('admin.blogs.index') }}" class="button btn_verde">Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer> </x-footer>
</div>


@endsection