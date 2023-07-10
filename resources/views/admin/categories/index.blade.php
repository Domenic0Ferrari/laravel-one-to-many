@extends('admin.layouts.base')

@section('contents')
<h1 class="text-center mt-3 mb-3">Categories</h1>

{{-- @if (session('delete_success'))
@php
    $post = session('delete_success')
@endphp
    <div class="alert alert-danger">
        Il post "{{ $post->title }}" è stato eliminato per sempre
    </div>
@endif --}}

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('admin.categories.show', ['category' => $category]) }}" class="btn btn-primary">View</a>
                {{-- <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $categori->id }}">
                    Delete
                </button> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>  

{{-- <div
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
                action="{{ route('admin.categories.destroy', ['categori' => $categori]) }}"
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
</div> --}}

@endsection