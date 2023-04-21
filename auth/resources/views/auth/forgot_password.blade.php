 
@extends('layouts.app')
 
@section('title', 'forgot password page')
 
@section('content')

<h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>

<p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>

<form action="{{route('auth.forgot_password.email')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <span class=" invalid-feedback mt-2">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit">login</button>
</form>
@endsection