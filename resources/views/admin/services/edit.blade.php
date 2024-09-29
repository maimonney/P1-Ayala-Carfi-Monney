@extends('layouts.main')

@section('title', 'Editar Servicio')

@section('content')

<div>
    <x-nav_admin></x-nav_admin>
    <div class="mt-5 cont_div_admin">
        <h1 class="mb-3">Editar Servicio</h1>

        @if ($errors->any())
            <div class="alert_error">
                Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
            </div>
        @endif

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data"
            class="cont_form_admin">
            @csrf
            @method('PUT')

            <div class="form_admin">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $service->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form_text">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control"
                            required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="text" name="price" id="price" class="form-control"
                            value="{{ old('price', $service->price) }}" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 select_form">
                        <label for="category" class="form-label">Categoría</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Desarrollo Web" {{ old('category', $service->category) == 'Desarrollo Web' ? 'selected' : '' }}>Desarrollo Web</option>
                            <option value="Marketing" {{ old('category', $service->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Diseño Gráfico" {{ old('category', $service->category) == 'Diseño Gráfico' ? 'selected' : '' }}>Diseño Gráfico</option>
                            <option value="SEO" {{ old('category', $service->category) == 'SEO' ? 'selected' : '' }}>SEO
                            </option>
                            <option value="Social Media" {{ old('category', $service->category) == 'Social Media' ? 'selected' : '' }}>Social Media</option>
                            <option value="Desarrollo de Apps" {{ old('category', $service->category) == 'Desarrollo de Apps' ? 'selected' : '' }}>Desarrollo de Apps</option>
                        </select>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 select_form">
                            <label for="image" class="form-label">Imagen</label>
                            <div id="imagePreview" class="mt-2" style="{{ $service->image ? '' : 'display:none;' }}">
                                <img id="preview" src="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                                    alt="{{ old('title', $service->title) }}" class="img-thumbnail"
                                    style="max-width: 200px;">
                            </div>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                style="opacity: 0; position: absolute; pointer-events: none;"
                                onchange="previewImage(event)">

                            <button type="button" class="button btn_lila mt-4"
                                onclick="if (validateAndUpload()) { document.getElementById('image').click(); }">
                                Seleccionar Imagen
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="button btn_celeste">Actualizar Servicio</button>
        </form>
    </div>

    <x-footer></x-footer>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');

        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(event.target.files[0]);
        } else {
            imagePreview.style.display = 'none';
        }
    }

    function validateAndUpload() {
        const imageInput = document.getElementById('image');
        if (imageInput.files.length === 0) {
            if (!document.getElementById('preview').src) {
                alert("Por favor, selecciona una imagen.");
                return false;
            }
        }
        return true;
    }
</script>

@endsection