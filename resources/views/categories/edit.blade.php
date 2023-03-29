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

            @method('PUT')

            @csrf

            <label>Category Name</label> <br>
            <input type="text" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') ? old('name') : $category->name }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br><br>

            <label>Category Slug</label> <br>
            <input type="text" name="slug" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}"
                value="{{ old('slug') ? old('slug') : $category->slug }}">
            <div class="invalid-feedback">
                {{ $errors->first('slug') }}
            </div>
            <br><br>

            @if ($category->image)
                <span>Current Image</span><br>
                <img src="{{ asset('storage/' . $category->image) }}" width="120px">
                <br><br>
            @endif

            <input type="file" name="image" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}">
            <small class="text-muted">Kosongkan Jika Tidak Ingin Mengubah Gambar</small>
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <br><br>

            <input type="submit" class="btn btn-primary" value="update">
        </form>
    </div>
@endsection
