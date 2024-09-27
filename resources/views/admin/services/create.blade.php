@extends('layouts.main')

@section('title', 'Nuevo Servicio')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Publicar Nuevo Servicio</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
            </div>
            @endif

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="{{ old('title') }}" required>

                    @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        required>{{ old('description') }}</textarea>

                    @error('description')
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
                        value="{{ old('price') }}" required>

                    @error('price')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Categoría</label>
                    <input
                        type="text"
                        name="category"
                        id="category"
                        class="form-control"
                        value="{{ old('category') }}" required>

                    @error('category')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Duración (minutos)</label>
                    <input
                        type="number"
                        name="duration"
                        id="duration"
                        class="form-control"
                        value="{{ old('duration') }}" required>

                    @error('duration')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control"
                        accept="image/*" required>

                    @error('image')
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
