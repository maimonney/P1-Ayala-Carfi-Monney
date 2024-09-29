@extends('layouts.main')

@section('title', 'Detalle del Blog')

@section('content')

<div class="col-12">
    <!-- Nav -->
    <x-nav></x-nav>

    <div class="container">

        <div class="cont_vista">
            <div class="row cont_row_vista">
                <div class="col-md-4">
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                        class="img-fluid">

                        @if ($blog->author)
                            <p><strong>Autor:</strong> {{ $blog->author->name }}</p>
                        @else
                            <p><strong>Autor:</strong> Desconocido</p>
                        @endif
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h1 class="card-title">{{ $blog->title }}</h1>
                        <p class="card-text"><i>{{ $blog->description }}</i></p>
                        <p class="card-text">{{ $blog->content }}</p>
                    </div>

                    <div class="card_footer">
                        @if ($blog->tags)
                            <p><strong>Etiquetas:</strong> {{ implode(', ', explode(',', $blog->tags)) }}</p>
                        @endif

                        <p><strong>Publicado el:</strong> {{ $blog->published_at}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>
</div>

@endsection