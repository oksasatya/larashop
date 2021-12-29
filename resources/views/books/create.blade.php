@extends('layouts.global')
@section('title')
    Create Book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">
                @csrf

                <label for="title">Title</label><br>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Book Title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message  }}
                </div>
                @enderror
                <br>

                <label for="cover">Cover</label>
                <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" value="{{ old('cover') }}">
                @error('cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="description">description</label><br>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Give a description about this book" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                <br>

                <label for="categories">Categories</label><br>
                <select name="categories[]" multiple id="categories" class="form-control"></select>
                <br><br>

                <label for="stock">Stock</label><br>
                <input type="number" class="form-control @error('Stock') is-invalid @enderror" name="stock" id="stock" min="0" value="0" value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="author">Author</label><br>
                <input type="text" class="form-control  @error('author') is-invalid @enderror" value="{{ old('author') }}" name="author" id="author" placeholder="Book Author">
                @error('author')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="publisher">Publisher</label>
                <input type="text" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('author') }}" name="publisher" id="publisher" placeholder="Book publisher">
                @error('publisher')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror
                <br>

                <label for="price">Price</label><br>
                <input type="number" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Book Price">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror
                <br>

                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>

            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#categories').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/ajax/categories/search',
                crossDomain: true,
                cors:true,
                headers: {
                'Access-Control-Allow-Origin': true,
                'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, Authorization, X-Auth-Token',
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });
    </script>
@endsection
