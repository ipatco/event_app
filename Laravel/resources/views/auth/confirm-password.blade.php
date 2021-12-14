@extends('auth')
@section('title', 'Confirm your password')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Confirm your password.</h1>
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                </div>
                <form class="user" method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Confirm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
