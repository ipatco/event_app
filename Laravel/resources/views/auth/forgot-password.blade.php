@extends('auth')
@section('title', 'Login')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Forgot your password?</h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                </div>
                <form class="user" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Email Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
