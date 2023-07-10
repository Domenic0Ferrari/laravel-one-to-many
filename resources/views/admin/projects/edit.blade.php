@extends('admin.layouts.base')

@section('contents')

<h1 class="text-center">Modifica il progetto:</h1>
<form method="POST" action="{{ route('admin.projects.update', ['project' => $project]) }}" novalidate>
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" 
        class="form-control @error('title') is-invalid @enderror" id="title" 
        name="title" 
        value="{{old('title', $project->title)}}">
        {{-- passare il secondo argomento alla funzione old così che il campo esca già precompilato --}}
        <div class="invalid-feedback">
            @error('title')
            {{ $message }}
            @enderror
        </div>
    </div>
{{-- 
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
                <option value="{{ $category->id }}" @if (old('category_id', $project->category->id) == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('category_id')
            {{ $message }}
            @enderror
        </div>
    </div> --}}

    <div class="mb-3">
        <label for="author" class="form-label">Autore</label>
        <input type="text"
        class="form-control @error('author') is-invalid @enderror"
        id="author"
        name="author"
        value="{{old('author', $project->author)}}">
        <div class="invalid-feedback">
            @error('author')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control @error ('description') is-invalid @enderror" 
        name="description" 
        id="description"
        rows="3">{{ old('description', $project->description) }}</textarea>
        <div class="invalid-feedback">
            @error('description')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="url_github" class="form-label">Github</label>
        <input type="url"
        class="form-control @error('url_github') is-invalid @enderror"
        id="url_github"
        name="url_github"
        value="{{old('url_github', $project->url_github)}}">
        <div class="invalid-feedback">
            @error('url_github')
            {{ $message }}
            @enderror
        </div>
    </div>

    <button class="btn btn-primary mb-3">Save</button>
</form>

<a href="{{ route('admin.projects.index') }}" class="btn btn-primary">
    Torna alla index
</a>

@endsection