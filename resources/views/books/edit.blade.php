@extends('layouts.global')

@section('title')
    Edit Book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>

            @endif
            <form action="{{ route('books.update', [$book->id]) }}" method="POST" enctype="multipart/form-data"
                class="p-3 shadow-sm bg-white">

                @csrf
                @method('PUT')

                <label for="title">Title</label><br>
                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $book->title }}" name="title" placeholder="Book Title">
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                <br>


                <label for="cover">Cover</label><br>
                <small class="text-muted">Current Cover</small><br>
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" width="96px" alt="">
                @endif
                <br><br>

                <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                <br><br>

                <label for="slug">Slug</label><br>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ? old('slug') : $book->slug }}" name="slug" placeholder="enter-a-slug">
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                <br>

                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $book->description }}</textarea>
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control @error('categories') is-invalid @enderror"></select>
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                <br>
                <br>

                <label for="stock">Stock</label><br>
                <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock') ? old('stock') :  $book->stock }}"
                    placeholder="stock">
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                <br>


                <label for="suthor">Author</label>
                <input type="text" id="author" name="author" class="form-control @error('author') ? is-invalid @enderror" value="{{  old('author') ? old('author') : $book->author }}"
                    placeholder="Author">
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                <br>

                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') ? old('publisher') : $book->publisher }}">
                <br>

                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') ? old('price') : $book->price }}">
                <br>

                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>Publish</option>
                    <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>Draft</option>
                </select>
                <br>
                <button class="btn btn-primary" value="PUBLISH">Update</button>
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

        var categories = {!! $book->categories !!}

        categories.forEach(function(category) {
            var option = new Option(category.name, category.id, true, true);
            $('#categories').append(option).trigger('change');
        });
    </script>

@endsection
