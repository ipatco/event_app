@extends('auth')
@section('title', 'Login')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                </div>
                <form class="user" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input type="name" class="form-control form-control-user"
                            id="exampleInputName" aria-describedby="NameHelp"
                            placeholder="Enter Name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-user" name="role" required>
                            <option value="">Select Role</option>
                            <option value="user">User</option>
                            <option value="vendor">Vendor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter Email Address" name="email" value="{{ old('email') }}" required autofocus>
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
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Register Account
                    </button>
                </form>
                <hr>
                @if (Route::has('login'))
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>
                @endif
                <div class="text-center">
                    <a class="small" href="{{ url('/') }}">Back to Home!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
