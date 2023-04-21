@extends('layouts.app')

@section('title', 'login page')
 
@section('content')
    <form action="{{route('auth.reset.password')}}" method="post">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label for="password1" class="form-label">password</label>
            <input type="password" class="form-control @error('password1') is-invalid @enderror" name="password1" id="password1" value="{{ old('password1') }}">
            @error('password1')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password2" class="form-label">password</label>
            <input type="password" class="form-control @error('password2') is-invalid @enderror" name="password2" id="password2" value="{{ old('password2') }}">
            @error('password2')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">submit</button>
    </form>

    <a href="{{route('auth')}}">back to login page</a>
@endsection