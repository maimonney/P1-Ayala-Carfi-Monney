@extends('layouts.main')

@section('title', 'Blogs')

@section('content')
<div class="contenier">
    <div class="row">
        <div class="col-12">
            <!-- Nav -->
            <x-nav></x-nav>

            <div class="container">
                <h1 class="mb-4">Bienvenido a la página de Blogs</h1>

                <div>
                    <div class="row">
                        @php
                            $lastBlog = $blogs->last();
                        @endphp

                        @if ($lastBlog)
                            <div class="col-12 mb-3">
                                <div class="card h-100 cont_div">
                                    <div class="d-flex flex-column">
                                        <img src="{{ asset($lastBlog->image) }}" class="card-img-top w-60"
                                            alt="{{ $lastBlog->title }}">

                                        <div class="h-100">
                                            <div class="card-body">
                                                <h3>{{ $lastBlog->title }}</h3>
                                                <p>{{ \Illuminate\Support\Str::limit($lastBlog->description, 150) }}</p>
                                                @if($lastBlog->author)
                                                    <p><strong>Autor:</strong> {{ $lastBlog->author->name }}</p>
                                                @else
                                                    <p><strong>Autor:</strong> Desconocido</p>
                                                @endif

                                                <div class="d-flex justify-content-between">
                                                @if ($lastBlog->tags)
                                                    <p><strong>Etiquetas:</strong> {{ implode(', ', explode(',', $lastBlog->tags)) }}</p>
                                                @endif

                                                <p><strong>Publicado el:</strong> {{ $lastBlog->published_at ? date('d/m/Y', strtotime($lastBlog->published_at)) : '' }}</p>
                                            </div>
                                                <div class="button-container">
                                                    <a href="{{ route('blogs.show', $lastBlog->id) }}"
                                                        class="button btn_link">Ver más</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>No hay blogs disponibles.</p> 
                        @endif

                        <!-- Resto de blogs -->
                        @foreach($blogs as $blog)
                            @if ($blog != $lastBlog)
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="card h-100 cont_div" style="width: 25rem;">
                                    <img src="{{ asset($blog->image) }}" class="card-img-top"
                                            alt="{{ $blog->title }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $blog->title }}</h5>
                                            <p class="card-text">{{ $blog->description }}</p>
                                            <p><strong>Publicado el:</strong> {{ $blog->published_at ? date('d/m/Y', strtotime($blog->published_at)) : '' }}</p>
                                            @if($blog->author)
                                                <p><strong>Autor:</strong> {{ $blog->author->name }}</p>
                                            @else
                                                <p><strong>Autor:</strong> Desconocido</p>
                                            @endif
                                            @if ($blog->tags)
                                                <p><strong>Etiquetas:</strong> {{ implode(', ', explode(',', $blog->tags)) }}</p>
                                            @endif
                                        </div>
                                        <div class="button-container">
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="button btn_link">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
