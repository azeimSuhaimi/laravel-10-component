 
@extends('layouts.app')
 
@section('title', 'login page')
 
@section('content')

@include('partials.popup')

    <form action="{{route('auth.login')}}" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
            @error('password')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="remember_token"  class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">login</button>
    </form>

    <a href="{{route('auth.forgot_password')}}">forgot password</a>
@endsection