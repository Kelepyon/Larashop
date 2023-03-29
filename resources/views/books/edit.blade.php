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

            <form action="{{ route('books.update', [$book->id]) }}" enctype="multipart/form-data"
                class="p-3 shadow-sm bg-white" method="POST">

                @method('PUT')

                @csrf

                <label for="title">Title</label><br>
                <input type="text" class="form-control {{ $errors->first('title') ? 'is-invalid' : '' }}"
                    value="{{ old('title') ? old('title') : $book->title }}" name="title" placeholder="Book title">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                <br>

                <label for="cover">Cover</label><br>
                <small class="text-muted">Current cover</small><br>
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" width="96px">
                @endif
                <br><br>

                <input type="file" class="form-control {{ $errors->first('cover') ? 'is-invalid' : '' }}" name="cover">
                <small class="text-muted">Kosongkan jika tidak ingin mengubahcover</small>
                <div class="invalid-feedback">
                    {{ $errors->first('cover') }}
                </div>
                <br><br>

                <label for="slug">Slug</label><br>
                <input type="text" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}"
                    value="{{ $book->slug }}" name="slug" placeholder="enter-a-slug">
                <div class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </div>
                <br>

                <label for="description">Description</label><br>
                <textarea name="description" id="description"
                    class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}">{{ old('description') ? old('description') : $book->description }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" id="categories"
                    class="form-control {{ $errors->first('categories') ? 'is-invalid' : '' }}" multiple></select>
                <br>
                <br>

                <label for="stock">Stock</label><br>
                <input type="text" name="stock" id="stock"
                    class="form-control {{ $errors->first('stock') ? 'is-invalid' : '' }}" placeholder="Stock"
                    value="{{ old('stock') ? old('stock') : $book->stock }}">
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                <br>

                <label for="stock">Author</label><br>
                <input type="text" name="author" id="author"
                    class="form-control {{ $errors->first('author') ? 'is-invalid' : '' }}" placeholder="Author"
                    value="{{ old('author') ? old('author') : $book->author }}">
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                <br>

                <label for="publisher">Publisher</label><br>
                <input type="text" name="publisher" id="publisher"
                    class="form-control {{ $errors->first('publisher') ? 'is-invalid' : '' }}" placeholder="Publisher"
                    value="{{ old('publisher') ? old('publisher') : $book->publisher }}">
                <div class="invalid-feedback">
                    {{ $errors->first('publisher') }}
                </div>
                <br>

                <label for="price">Price</label><br>
                <input type="text" name="price" id="price"
                    class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" placeholder="Price"
                    value="{{ old('price') ? old('price') : $book->price }}">
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                <br>

                <label for="">Status</label>
                <select name="status" id="status"
                    class="form-control {{ $errors->first('status') ? 'is-invalid' : '' }}">
                    <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>PUBLISH</option> 
                    <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>

            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
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
