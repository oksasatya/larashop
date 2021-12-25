@extends('layouts.global')
@section('title')
    Create Category
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white shadow-sm p-3">
        @csrf

        <label for="CategoryName">Category Name</label><br>
        <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name">
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
        <br>

        <label for="CategoryImage">CategoryImage</label>
        <input type="file" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}" name="image">
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
        <br>

        <input type="submit" class="btn btn-primary" value="save">
    </form>

@endsection
