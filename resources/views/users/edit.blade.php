@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="col-md-8">
        {{-- Edited User {{ $users->username }} --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('users.update', [$users->id]) }}"
            method="POST">
            @csrf

            <input type="hidden" value="PUT" name="_method">

            <label for="name">Name</label>
            <input type="text" class="form-control  {{ $errors->first('name') ? 'is-invalid' : '' }}"
                placeholder="FullName" name="name" id="name" value="{{ $users->name }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>

            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" placeholder="username" id="username"
                value="{{ $users->username }}" disabled>

            <label for="status">Status</label>
            <br>
            <input {{ $users == 'ACTIVE' ? 'checked' : '' }} class="form-control" value="ACTIVE" type="radio"
                name="status" id="active">
            <label for="active">Active</label>

            <input {{ $users == 'INACTIVE' ? 'checked' : '' }} class="form-control" value="INACTIVE" type="radio"
                name="status" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>

            <label for="">Roles</label>
            <input type="checkbox" {{ in_array('ADMIN', json_decode($users->roles)) ? 'checked' : '' }} name="roles[]"
                id="ADMIN" value="ADMIN" class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="ADMIN">Administrator</label>

            <input type="checkbox" {{ in_array('STAFF', json_decode($users->roles)) ? 'checked' : '' }} name="roles[]"
                id="STAFF" value="STAFF" class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="STAFF">Staff</label>

            <input type="checkbox" {{ in_array('CUSTOMER', json_decode($users->roles)) ? 'checked' : '' }} name="roles[]"
                id="CUSTOMER" value="CUSTOMER" class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="CUSTOMER">Customer</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
            <br>

            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" name="phone"
                value="{{ old('phone') ? old('phone') : $users->phone }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>

            <br>
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}">{{ old('address') ? old('address') : $users->address }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>

            <label for="avatar">Avatar</label>
            <br>
            Current Avatar: <br>
            @if ($users->avatar)
                <img src="{{ asset('storage/' . $users->avatar) }}" width="120px">
                <br>
            @else
                No Avatar
            @endif
            <small class="text-muted">Kosongkan Jika Tidak Ingin Mengubah Avatar</small>

            <hr class="my-3">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" value="{{ $users->email }}"
                class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="user@mail.com"
                disabled>
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>

            <input type="submit" class="form-control" value="save">
        </form>
    </div>
@endsection
