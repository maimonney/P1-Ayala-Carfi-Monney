@extends('layouts.main')

@section('title', $movie->title)




<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav> </x-nav>
    <h1 class="mb-3 mt-3">{{ $movie->title }}</h1>
    {{--Todo aregar imagen para la portada --}}
    <dl>
        <dt class="mb-3">Precio</dt>
        <dd>${{$movie->price}}</dd>
        <dt>Fecha de estreno</dt>
        <dd>${{$movie->release_date}}</dd>

    </dl>
    <hr class="mb-3">
    <h2 class="mb-3">Sinopsis</h2>
    <p>{{ $movie->synopsis}}</p>
        </div>
    </div>
</div>

@section('content')
