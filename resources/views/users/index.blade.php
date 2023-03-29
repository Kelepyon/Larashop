@extends('layouts.global')

@section('title')
    Users List
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- <div class="row">
        <div class="col-md-6">
            <form action="{{ route('users.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control col-md-10"
                        placeholder="Filter Berdasarkan Email">

                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    <form action="{{ route('users.index') }}">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}"
                    placeholder="Masukan Email Untuk Filter...">
            </div>
            <div class="col-md-6">
                <input {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }} type="radio" name="status"
                    class="form-control" id="active" value="ACTIVE">
                <label for="active">Active</label>

                <input {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }} type="radio" name="status"
                    id="inactive" value="INACTIVE" class="form-control">
                <label for="inactive">Inactive</label>

                <input type="submit" class="btn btn-primary" value="Filter">
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>
    </div>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" width="70px" />
                        @else
                            N/A
                        @endif
                    </td>

                    <td>
                        @if ($user->status == 'ACTIVE')
                            <span class="badge badge-success">
                                {{ $user->status }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{ $user->status }}
                            </span>
                        @endif
                    </td>

                    <td>
                        {{-- [TODO: actions] --}}

                        <a class="btn btn-info text-white btn-sm" href="{{ route('users.edit', [$user->id]) }}">Edit</a>

                        <a class="btn btn-primary btn-sm" href="{{ route('users.show', [$user->id]) }}">Detail</a>

                        <form action="{{ route('users.destroy', [$user->id]) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete This User Permanently?')">

                            @csrf

                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger btn-sm">

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan=10>
                    {{ $users->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
