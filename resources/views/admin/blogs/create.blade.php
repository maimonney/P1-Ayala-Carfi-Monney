@extends('layouts.main')

@section('title', 'Nuevo Blog')

@section('content')
<div>
    <x-nav_admin></x-nav_admin>
    <div class="mt-5 cont_div_admin">

        <h1 class="mb-3">Publicar Nuevo Blog</h1>

        @if ($errors->any())
            <div class="alert_error">
                Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
            </div>
        @endif

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data"
            class="cont_form_admin">
            @csrf

            <div class="form_admin">
                <div class="col-md-6">
                    <!-- TITULO -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DESCRIPCION -->
                    <div class="mb-3 form_t">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description"
                            class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONTENIDO -->
                    <div class="mb-3 form_t">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- IMAGEN -->
                    <div class="mb-3 select_form">
                        <label for="image" class="form-label">Imagen</label>
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img id="preview" src="" alt="Previsualización de la imagen" class="img-thumbnail"
                                style="max-width: 200px;">
                        </div>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"
                            style="display: none;" onchange="previewImage(event)">
                        <button type="button" class="button btn_lila mt-4"
                            onclick="document.getElementById('image').click();">
                            Seleccionar Imagen
                        </button>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TAGS -->
                    <div class="mb-3 form_t">
                        <label for="tags" class="form-label">Etiquetas (separadas por comas)</label>
                        <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
                        @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- FECHA DE PUBLICACIÓN -->
                    <div class="mb-3 form_t">
                        <label for="publish_date" class="form-label">Fecha de Publicación</label>
                        <input type="date" name="publish_date" id="publish_date" class="form-control"
                            value="{{ old('publish_date') }}">
                        @error('publish_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="button btn_celeste">Publicar</button>
        </form>
    </div>

    <x-footer></x-footer>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }
</script>

@endsection