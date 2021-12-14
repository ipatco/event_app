@extends('admin')
@section('title', 'View Booking')

@section('css')
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Booking</h1>
        <a href="{{ route('admin.events') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Back
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Booking</h6>
        </div>
        <div class="card-body">
            {{-- View Single booking --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        @if($booking->event)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Name:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->title }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Date:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ date('M d, Y', strtotime($booking->event->start_date)) }} to {{ date('M d, Y', strtotime($booking->event->end_date)) }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Location:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->location }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Description:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->description }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Category:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->category->name }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Organiser:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->o_name }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Organiser Phone:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->o_phone }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Event Organiser Email:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->o_email }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Organiser Website:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->event->o_website }}</h5>
                            </div>
                        </div>
                        @else
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Service Name:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->service->title }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Service Date:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ date('M d, Y', strtotime($booking->service->start_date)) }} to {{ date('M d, Y', strtotime($booking->service->end_date)) }}</h5>
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Name:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->name }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Email:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->email }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Phone:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->phone }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Date:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->booking_date }}</h5>
                            </div>
                        </div>
                        @if($booking->transaction)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Payment ID:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->transaction->payment_id }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Payment Status:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->transaction->payment_status }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h5>Booking Payment Amount:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $booking->transaction->payment_currency.' '.$booking->transaction->payment_amount }}</h5>
                            </div>
                        </div>
                        @else
                        <h3>Payment not done</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
