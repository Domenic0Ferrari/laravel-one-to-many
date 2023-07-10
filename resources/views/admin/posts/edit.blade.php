@extends('admin.layouts.base')

@section('contents')

<h1>Modifica un Post</h1>
<form method="POST" action="{{ route('admin.posts.update', ['post' => $post]) }}" novalidate>
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" 
        class="form-control @error('title') is-invalid @enderror" id="title" 
        name="title" 
        value="{{old('title', $post->title)}}">
        {{-- passare il secondo argomento alla funzione old così che il campo esca già precompilato --}}
        <div class="invalid-feedback">
            @error('title')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label 
        for="category"
        class="form-label">Category</label>
        <select
        class="form-select
        @error('category_id') is invalid @enderror" aria-label="category"
        id="category"
        name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if (old('category_id', $post->category->id) == $category->id) selected @endif>{{ $category->name }}</option>
                {{-- utilizzare i due uguali e non i tre uguali altrimenti non funziona...fare attenzione --}}
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('category_id')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="url_image" class="form-label">Immagine</label>
        <input type="url"
        class="form-control @error('url_image') is-invalid @enderror"
        id="url_image"
        name="url_image"
        value="{{old('url_image', $post->url_image)}}">
        <div class="invalid-feedback">
            @error('url_image')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Contenuto</label>
        <textarea class="form-control @error ('content') is-invalid @enderror" 
        name="content" 
        id="content"
        rows="3">{{ old('content', $post->content) }}</textarea>
        <div class="invalid-feedback">
            @error('content')
            {{ $message }}
            @enderror
        </div>
    </div>

    <button class="btn btn-primary">Save</button>
</form>

@endsection