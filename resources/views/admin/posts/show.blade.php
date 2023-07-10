@extends('admin.layouts.base')

@section('contents')
    <h1 class="text-center">{{ $post->title }}</h1>
    {{-- voglio visualizzare la categoria --}}
    <h2 class="text-center">Category: {{ $post->category->name }}</h2>
    {{-- scrivendo $post->category mi restituisce tutto l'oggetto della categoria, se a me serve solo il nome inserisco un'altra freccia ed entro in quell'oggetto --}}
    <img src="{{ $post->url_image }}" alt="{{ $post->title }}">
    <p>{{ $post->content }}</p>
@endsection