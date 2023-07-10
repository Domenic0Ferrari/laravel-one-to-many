@extends('admin.layouts.base')

@section('contents')
<h1 class="text-center mt-3 mb-3">Post</h1>

@if (session('delete_success'))
@php
    $post = session('delete_success')
@endphp
    <div class="alert alert-danger">
        Il post "{{ $post->title }}" è stato eliminato per sempre
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Category</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td><a href="{{ route('admin.categories.show', ['category' => $post->category]) }}">{{ $post->category->name }}</a></td>
            <td>{{ $post->url_image }}</td>
            <td>
                <a href="{{ route('admin.posts.show', ['post' => $post]) }}" class="btn btn-primary">View</a>
                <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $post->id }}">
                    {{-- aggiungo data-id per passare data a js, inserirò qui l'identificatore...aggiugno codice js inn app.js --}}
                    Delete
                </button>
                {{-- il button richiama il modal con data-bs-target --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>  

<div
class="modal fade"
id="deleteModal"
data-bs-backdrop="static"
data-bs-keyboard="false"
tabindex="-1"
aria-labelledby="deleteModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Conferma eliminazione!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Sei sicuro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form
                action="{{ route('admin.posts.destroy', ['post' => $post]) }}"
                method="POST"
                class="d-inline-block" 
                id="confirm-delete">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{ $posts->links() }}
{{-- <div class="d-flex gap-2">
@foreach ($posts as $post)
    <div class="card" style="width: 18rem;">
        <img src="{{ $post->url_image }}" class="card-img-top" alt="{{ $post->title }}">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary align-self-end">View</a>
            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">Edit</a>
            <form
            action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"
            method="POST"
            class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
    {{ $posts->links() }} --}}

@endsection