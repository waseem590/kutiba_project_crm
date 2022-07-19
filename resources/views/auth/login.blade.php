@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <form method="POST" action="{{ route('login') }}" autocomplete='on'>
        @csrf
        <div class="form-group">
            <label class="" for="">Username</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="" value="">
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

        <div class="form-group-custom">
            <!-- <input type="checkbox" id="html"> -->
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember me</label>
            <div class="forgot-pswd"><a href="{{ route('password.request') }}">Forgot Password?</a></div>
        </div>
        <button type="submit" class="login-btn">Login</button>
    </form>
    <!-- <span>Don't have an account yet?<a class="btn btn-link" href="/register">Sign Up</a>
    </span> -->

@endsection
