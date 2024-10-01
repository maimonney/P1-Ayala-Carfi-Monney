@extends('layouts.main')

@section('title', 'Nuevo Servicio')

@section('content')
    <div>
        <x-nav_admin></x-nav_admin>
        <div class="mt-5 cont_div_admin">

                <h1 class="mb-3">Publicar Nuevo Servicio</h1>

                @if ($errors->any())
                    <div class="alert_error">
                        Hay errores en los datos del formulario. Por favor, revisarlos y volver a intentar.
                    </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="cont_form_admin">
                    @csrf

                    <div class="form_admin">
                        <div class="col-md-6 ">
                            <!-- TITULO -->
                            <div class="mb-3 adm_div">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- PRECIO -->
                             <div class="mb-3 adm_div">
                                <label for="price" class="form-label">Precio</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DESCRIPCION -->
                            <div class="mb-3 form_t adm_div">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 ">
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

                            <!-- CATEGORIA -->
                            <div class="mb-3 select_form">
                                <label for="category" class="form-label">Categoría</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Seleccione una categoría</option>
                                    <option value="Desarrollo Web" {{ old('category') == 'Desarrollo Web' ? 'selected' : '' }}>Desarrollo Web</option>
                                    <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>
                                        Marketing
                                    </option>
                                    <option value="Diseño Gráfico" {{ old('category') == 'Diseño Gráfico' ? 'selected' : '' }}>Diseño Gráfico</option>
                                    <option value="SEO" {{ old('category') == 'SEO' ? 'selected' : '' }}>SEO</option>
                                    <option value="Social Media" {{ old('category') == 'Social Media' ? 'selected' : '' }}>
                                        Social Media</option>
                                    <option value="Desarrollo de Apps" {{ old('category') == 'Desarrollo de Apps' ? 'selected' : '' }}>Desarrollo de Apps</option>
                                </select>
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DURACION -->
                            <div class="mb-3 select_form">
                                <label for="duration" class="form-label">Duración (meses)</label>
                                <input type="number" name="duration" id="duration" class="form-control"
                                    value="{{ old('duration') }}">
                                @error('duration')
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