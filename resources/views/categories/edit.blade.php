@extends('layouts.global')

@section('title')
    Edit Category
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-8">
        <form action="{{ route('categories.update', [$category->id]) }}" enctype="multipart/form-data" method="POST"
            class="bg-white shadow-sm p-3">
            @csrf
            <input type="hidden" value="put" name="_method">
            <label for="CategoryName">Category Name</label><br>
            <input type="text" class="form-control" value="{{ $category->name }}" name="name">
            <br><br>

            <label for="CategorySlug">Category Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}">
            <br><br>

            @if ($category->image)
                <span>Current Image</span><br>
                <img src="{{ asset('storage/' . $category->image) }}" width="120px" alt="CurrentImage">
                <br><br>
            @endif
            <input type="file" class="form-control" name="image">
            <small class="text-muted">Kosongkan jika Tidak ingin mengubah Gambar</small>
            <br><br>

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>

@endsection
