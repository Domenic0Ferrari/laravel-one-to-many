@extends('admin.layouts.base')

@section('contents')

<h1>Inserisci un nuovo Post</h1>
<form method="POST" action="{{ route('admin.posts.store') }}" novalidate>
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" 
        class="form-control @error('title') is-invalid @enderror" id="title" 
        name="title" 
        value="{{old('title')}}">
        <div class="invalid-feedback">
            @error('title')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" aria-label="category" id="category" name="category_id">
            {{-- aggiungiamo il name usato nel PostController per legare il select al db --}}
            <option selected>Open this select menu</option>
            {{-- <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option> --}}
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            {{-- la richista la facciamo nel controller --}}

            @endforeach
            <div class="invalid-feedback">
                @error('title')
                {{ $message }}
                @enderror
            </div>
            
        </select>
    </div>

    <div class="mb-3">
        <label for="url_image" class="form-label">Immagine</label>
        <input type="url"
        class="form-control @error('url_image') is-invalid @enderror"
        id="url_image"
        name="url_image"
        value="{{old('url_image')}}">
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
        rows="3">{{ old('content') }}</textarea>
        <div class="invalid-feedback">
            @error('content')
            {{ $message }}
            @enderror
        </div>
    </div>

    <button class="btn btn-primary">Save</button>
</form>

@endsection