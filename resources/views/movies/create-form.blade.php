@extends('layouts.main')

@section('title', 'Publicar una Nueva Pelicula')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Publicar una pelicula</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                Hay errores en los datos del formulario. Por favor, revisarlos y volvé a intentar
            </div>
            @endif

            <form action="{{ route('movies.create.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titulo</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="{{ old('title') }}">

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
                        value="{{ old('price') }}">
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
                        value="{{ old('release_date') }}">
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
                        >{{ old('synopsis') }}</textarea>
                        @error('synopsis')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>

        </div>
    </div>
</div>
@endsection
