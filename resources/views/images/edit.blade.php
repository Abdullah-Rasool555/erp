@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Image</h2>

    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $image->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset('storage/' . $image->image_path) }}" width="100">
        </div>
        <div class="mb-3">
            <label class="form-label">New Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
