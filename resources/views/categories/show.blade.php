@extends('layouts.global')

@section('title')
    Detail Category
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <label for="CategoryName">Category Name</label><br>
                {{ $category->name }}
                <br><br>

                <label for="CategorySlug"><b>Category Slug</b></label><br>
                {{ $category->slug }}
                <br><br>

                <label for="CategoryImage"><b>Category Image</b></label>
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" width="120px">
                @endif
            </div>
        </div>
    </div>

@endsection
