
@extends('auth')
@section('title', 'Verify your Email')

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Verify your Email</h1>
                    <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>

                    @if (session('status') == 'verification-link-sent')
                        <p>A new verification link has been sent to the email address you provided during registration.</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-primary btn-user btn-block mb-2">Resend Verification Email</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-user btn-block">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
