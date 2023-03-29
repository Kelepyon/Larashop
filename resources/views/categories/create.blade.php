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

    <form action="{{ route('categories.store') }}" enctype="multipart/form-data" class="bg-white shadow-sm p-3" method="POST">
        @csrf

        <label>Category Name</label>
        <input type="text" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
            value={{ old('name') }}>
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
        <br>

        <label>Category Image</label>
        <input type="file" name="image" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}">
        <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
        <br>

        <input type="submit" value="save" class="btn btn-primary">
    </form>
@endsection
