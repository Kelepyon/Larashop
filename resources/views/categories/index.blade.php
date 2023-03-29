@extends('layouts.global')

@section('title')
    Category List
@endsection

@section('content')
    @if (session('status'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter by category name"
                        value="{{ Request::get('name') }}" name="name">

                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 mb-5">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('categories.index') }}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.trash') }}">Trash</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12 text-right ml-2">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create category</a>
            </div>
        </div>
        <br><br>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Slug</b></th>
                        <th><b>Image</b></th>
                        <th><b>Actions</b></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" width="48px">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', [$category->id]) }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('categories.show', [$category->id]) }}"
                                    class="btn btn-primary btn-sm">Show</a>

                                <form action="{{ route('categories.destroy', [$category->id]) }}" class="d-inline"
                                    method="POST" onsubmit="return confirm('Move Category To Trash?')">

                                    @csrf

                                    @method('DELETE')

                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            {{ $categories->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
