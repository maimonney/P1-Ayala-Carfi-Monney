@extends('layouts.main')

@section('title', 'Peliculas')

@section('content')

<div class="container">
   <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center">Listado de Peliculas</h1>
            <div class="mb-3 d-flex justify-content-center">
                <a href="{{ route('movies.create.form') }}" class="text-decoration-none text-white bg-primary rounded p-2 px-3">Publicar una nueva pelicula</a>
            </div>

            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Fecha de Estreno</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{ $movie->movie_id }}</td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->price }}</td>
                            <td>{{ $movie->release_date }}</td>
                            <td><a  href="{{ route('movies.view', ['id' => $movie->movie_id] ) }}"
                                    class="btn btn-primary">Ver</a>
                                <a  href="{{ route('movies.edit.form', ['id' => $movie->movie_id]) }}"
                                    class="btn btn-secondary ms-2">
                                    Editar
                                </a>
                                <form action="{{ route('movies.delete.process', ['id' => $movie->movie_id]) }}"
                                    method="post">
                                    @csrf
                                    <input type="submit"
                                    onclick="return confirm('esta seguro de borrar la pelicula?')"
                                    class="btn btn-danger ms-2"
                                    value="Eliminar">
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </thead>
            </table>
        </div>
    </div>
</div>
