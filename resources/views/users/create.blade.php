@extends('layouts.global')

@section('title')
    Create New User
@endsection

@section('content')
    <div class="col-md-8">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input value="{{ old('name') }}" type="text"
                class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Full Name" name="name"
                id="name">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>

            <label for="Username">Username</label>
            <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                placeholder="Username" name="username" id="username">
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
            <br>

            <label for="">Roles</label>
            <br>
            <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN"
                class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="ADMIN">Administrator</label>

            <input type="checkbox" name="roles[]" id="STAFF" value="STAFF"
                class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="STAFF">Staff</label>

            <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER"
                class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}">
            <label for="CUSTOMER">Customer</label>
            <br>

            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>

            <br>
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}">{{ old('address') }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>

            <br>
            <label for="avatar">Avatar Image</label>
            <br>
            <input type="file" class="form-control" id="avatar" name="avatar"
                class="form-control
            {{ $errors->first('avatar') ? 'is-invalid' : '' }}">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>

            <hr class="my-3">

            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="user@mail.com">
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" placeholder="password">
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            <br>

            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
                name="password_confirmation" placeholder="password confirmation" id="password_confirmation">
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
            <br>

            <input value="save" class="btn btn-primary" type="submit">
        </form>
    </div>
@endsection
