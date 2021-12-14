@extends('auth')
@section('title', 'Login')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                </div>
                <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="current-password">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>
                <hr>
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                    </div>
                @endif
                <div class="text-center">
                    <a class="small" href="{{ url('/') }}">Back to Home!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
