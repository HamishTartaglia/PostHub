@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center p-4">
        <div class="col-md-5">
            <div class="create-title">
                <h5>Login</h5>
            </div><br>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h6>E-Mail Address:</h6>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>

                <h6>Password:</h6>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br>

                <div class="d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <br>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn">
                        {{ __('Login') }}
                    </button>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Your Password?</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
