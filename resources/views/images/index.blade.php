@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Image List</h2>
    <a href="{{ route('images.create') }}" class="btn btn-success">Upload New Image</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        @foreach ($images as $image)
        <tr>
            <td>{{ $image->title }}</td>
            <td><img src="{{ asset('storage/' . $image->image_path) }}" width="100"></td>
            <td>
                <a href="{{ route('images.edit', $image->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
