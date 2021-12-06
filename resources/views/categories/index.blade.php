@extends('layouts.global')

@section('title')
    Category list

@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter berdasarkan category name" name="name"
                        value="{{ Request::get('name') }}">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }} " class="nav-link active">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.trash') }}" class="nav-link">Trash</a>
                </li>

            </ul>
        </div>
    </div>
    <hr class="my-3">
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Slug</b></th>
                        <th><b>Image</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="CategoryImage"
                                        width="40px">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', [$category->id]) }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('categories.show', [$category->id]) }} "
                                    class="btn btn-primary btn-sm">Show</a>
                                <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST"
                                    onsubmit="return confirm('Move Category To Trash?')" class="d-inline">
                                    @csrf

                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger btn-sm" value="Trash">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
