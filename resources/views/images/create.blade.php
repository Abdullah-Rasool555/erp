@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Image</h2>

    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Select Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
