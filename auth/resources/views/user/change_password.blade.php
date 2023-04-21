@extends('layouts.app')

@section('title', 'change password page')
 
@section('content')

@include('partials.popup')

    <form action="{{route('user.change_password_process')}}" method="post">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
            @error('password')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password1" class="form-label">password 1</label>
            <input type="password" class="form-control @error('password1') is-invalid @enderror" name="password1" id="password1" value="{{ old('password1') }}">
            @error('password1')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password2" class="form-label">password 2</label>
            <input type="password" class="form-control @error('password2') is-invalid @enderror" name="password2" id="password2" value="{{ old('password2') }}">
            @error('password2')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">submit</button>
    </form>

    <a class="btn btn-primary" href="{{route('auth.logout')}}">logout</a>
    <a class="btn btn-primary" href="{{route('user.profile')}}">profile</a>
@endsection