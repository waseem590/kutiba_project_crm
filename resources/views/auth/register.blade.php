@extends('layouts.app')
@section('title', 'Register')

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="" for="">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="" for="">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group cust-mt">
            <label class="" for="">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group cust-mt">
            <label class="" for="">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your password">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="login-btn">SignUp</button>
    </form>
    <span>Already have an account?<a class="btn btn-link" href="/login">Login</a>
    </span>
@endsection
