@extends('layouts.main')

@section('title', 'Editar Servicio')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Editar Servicio</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en los datos del formulario. Por favor, revísalos y vuelve a intentar.
                </div>
            @endif

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $service->title) }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description"
                        class="form-control">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="text" name="price" id="price" class="form-control"
                        value="{{ old('price', $service->price) }}">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if ($service->image)
                        <p class="mt-2">Imagen actual:</p>
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="img-thumbnail"
                            style="max-width: 200px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
            </form>

        </div>
    </div>
</div>

@endsection