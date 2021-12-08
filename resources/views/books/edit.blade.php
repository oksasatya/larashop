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
                <input type="text" class="form-control" value="{{ $book->title }}" name="title" placeholder="Book Title">
                <br>


                <label for="cover">Cover</label><br>
                <small class="text-muted">Current Cover</small><br>
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" width="96px" alt="">
                @endif
                <br><br>

                <input type="file" class="form-control" name="cover">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <br><br>

                <label for="slug">Slug</label><br>
                <input type="text" class="form-control" value="{{ $book->slug }}" name="slug" placeholder="enter-a-slug">
                <br>

                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control"></select>
                <br>
                <br>

                <label for="stock">Stock</label><br>
                <input type="text" class="form-control" name="stock" id="stock" value="{{ $book->stock }}"
                    placeholder="stock">
                <br>


                <label for="suthor">Author</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}"
                    placeholder="Author">
                <br>

                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" class="form-control" value="{{ $book->publisher }}">
                <br>

                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ $book->price }}">
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
