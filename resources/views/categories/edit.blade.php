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
            @method('PUT')
            <label for="CategoryName">Category Name</label><br>
            <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') ? old('name') : $category->name }}" name="name">

            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            .
            <br><br>

            <label for="CategorySlug">Category Slug</label>
            <input type="text" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}" name="slug" id="slug"
                value="{{ old('slug') ? old('slug') : $category->slug }}">

            <div class="invalid-feedback">
                {{ $errors->first('slug') }}
            </div>
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
