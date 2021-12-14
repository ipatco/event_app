
@extends('auth')
@section('title', 'Reset Password')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                </div>
                <form class="user" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter Email Address..." name="email" value="{{ old('email', request()->email) }}" required autofocus>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password" name="password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
