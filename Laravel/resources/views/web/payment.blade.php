@extends('web')
@section('title', 'Make Payment')

@section('css')
@endsection

@section('page')
    <div class="row">
        @php
            $person = 1;
            if($booking->service_id > 0){
                $person = 1;
            }
            elseif($booking->event_id > 0){
                $person = $booking->num_of_people;
            }
        @endphp

        <div class="offset-md-3 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    @if($type == 's')
                    <h6 class="m-0 font-weight-bold text-primary">Pay ${{ $price }} for "{{ $title }}"</h6>
                    @elseif($type == 'e')
                    <h6 class="m-0 font-weight-bold text-primary">Pay ${{ $price*$person }} for {{ $person }} people/person for "{{ $title }}"</h6>
                    @endif
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('booking.payment', $booking->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" disabled readonly value="{{ $booking->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" disabled readonly value="{{ $booking->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" class="form-control" disabled readonly value="{{ $booking->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Date</label>
                            <input type="text" class="form-control" disabled readonly value="{{ $booking->booking_date }}" required>
                            <input type="hidden" class="form-control" name="amount" value="{{ $price*$person }}" required>
                        </div>
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="{{ $price*$person*100 }}"
                                data-name="{{ env('APP_NAME') }}"
                                data-description="Pay ${{ $price*$person }} to confirm your order"
                                data-email="{{ Auth::user()->email }}"
                                data-locale="auto" data-zip-code="false" data-currency="usd">
                        </script>
                        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
