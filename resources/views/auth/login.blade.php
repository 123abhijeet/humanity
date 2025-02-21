@extends('frontend.layouts.master')
@section('title','Home | Humanity')
@section('body')
<section id="login">
    <div class="container">
        <div class="section-header">
            <h3>Login</h3>
        </div>
        <div class="row">
            <div class="col-md-12 form">
                <form method="post" action="{{route('login')}}" id="loginForm">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Your Email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Your Password" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember2" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember2">Remember me</label>
                        </div>
                    </div>
                    <div><button type="submit" id="loginBtn">Sign In</button></div>
                    @if (Route::has('password.request'))
                    <div class="text-center">
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loginBtn = document.getElementById('loginBtn');
        var loginForm = document.getElementById('loginForm');

        loginBtn.addEventListener('click', function() {
            loginBtn.disabled = true; // Disable the button to prevent double-click
            loginForm.submit(); // Submit the form
        });
    });
</script>
@endsection