@extends('web')
@section('title', $event->title)

@section('css')
@endsection

@section('page')

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary m-auto h2">{{ $event->title }}</h6>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p>{{ $event->description }}</p>
                                <h6><span class="h5">Price: </span>${{ ($event->sale_price > 0) ? $event->sale_price : $event->price }} per person</h6>
                                <h6><span class="h5">Event Date: </span>{{ date('M d, Y', strtotime($event->start_date)) }} to {{ date('M d, Y', strtotime($event->end_date)) }}</h6>
                                <h6><span class="h5">Event Location: </span>{{ $event->location }}</h6>
                                <h6><span class="h5">Event Category: </span>{{ $event->category->name }}</h6>
                                <h6><span class="h5">Event Organiser: </span>{{ $event->o_name }}</h6>
                                <h6><span class="h5">Event Organiser Phone: </span>{{ $event->o_phone }}</h6>
                                <h6><span class="h5">Event Organiser Email: </span>{{ $event->o_email }}</h6>
                                <h6><span class="h5">Booking Organiser Website: </span><a href="{{ $event->o_website }}">{{ $event->o_website }}</a></h6>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('uploads/events/'.$event->image) }}" class="img-fluid mb-4 w-100" alt="">
                                @if($event->video != '')
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $event->video }}" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($event->booking_status == 1)
                        <a href="{{ route('event.booking', $event->id) }}" class="btn btn-primary">
                            Book this event
                        </a>
                    @else
                        <div class="alert alert-danger">
                            <strong>Booking is not available for this event</strong>
                        </div>
                        <a href="#" class="btn btn-primary disabled">
                            Book this event
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
