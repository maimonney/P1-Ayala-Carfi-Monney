@extends('layouts.main')

@section('title', 'Editar pelicula '.e($movie->title))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Editar pelicula {{ $movie->title }}</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                Hay errores en los datos del formulario. Por favor, revisarlos y volvé a intentar
            </div>
            @endif

            <form action="{{ route('movies.edit.process', ['id' => $movie->movie_id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titulo</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="{{ old('title', $movie->title) }}">

                        @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input
                        type="text"
                        name="price"
                        id="price"
                        class="form-control"
                        value="{{ old('price', $movie->price) }}">
                        @error('price')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="release_date" class="form-label">Fecha de Estreno</label>
                    <input
                        type="date"
                        name="release_date"
                        id="release_date"
                        class="form-control"
                        value="{{ old('release_date', $movie->release_date) }}">
                        @error('release_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea
                        name="synopsis"
                        id="synopsis"
                        class="form-control"
                        >{{ old('synopsis', $movie->synopsis) }}</textarea>
                        @error('synopsis')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary">Grabar</button>
            </form>

        </div>
    </div>
</div>
@endsection
