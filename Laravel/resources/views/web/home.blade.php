@extends('web')
@section('title', 'Home')

@section('css')
<style>
    .jumbotron {
        padding: 0rem 2rem;
    }
</style>
@endsection

@section('page')

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card bg-000 border-left-danger shadow h-100 py-2 border-bottom-danger">
                <div class="card-body">
                    <div class="jumbotron bg-000">
                        <h1 class="display-4 text-white">Events & Services Simplified</h1>
                        <p class="lead text-white fs-p">
                            Managing Events & related Services is just a cool breeze now with everything in one place. Bye bye to all the hassle. Just relax and enjoy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($events) > 0)
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
            <h1 class="h3 mb-0 text-gray-800">Events</h1>
        </div>
        <div class="row">
        {{-- Events --}}
            @foreach ($events as $event)
                <div class="col-xl-3 col-lg-3 showbtn">
                    <div class="card shadow mb-4">
                        <img class="img-fluid m-3 imgg" src="{{ asset('uploads/events/'.$event->image) }}" alt="">
                        <div class="detail-btn">
                            <a href="{{ route('event.detail', $event->slug) }}" class="btn btn-primary btn-sm center-of-card-img">Detail</a>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1 trim-text">{{ $event->title }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">${!! ($event->sale_price > 0) ? '<s class="mr-3">'.$event->price.'</s>' . '$'.$event->sale_price : $event->price !!} per Ticket</div>
                                    <div class="text-sm mb-0 font-weight-bold text-gray-800"><i class="fas fa-calendar-alt"></i> {{ $event->start_date . ' - ' . $event->end_date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if (count($services) > 0)
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
            <h1 class="h3 mb-0 text-gray-800">Services</h1>
        </div>
        <div class="row">
            {{-- services --}}
            @foreach ($services as $service)
                <div class="col-xl-3 col-lg-3 showBtns">
                    <div class="card shadow mb-4">
                        <img class="img-fluid m-3 imgg" src="{{ asset('uploads/services/'.$service->image) }}" alt="">
                        <div class="detail-btn">
                            <a href="{{ route('service.detail', $service->slug) }}" class="btn btn-primary btn-sm center-of-card-img">Detail</a>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 trim-text">{{ $service->title }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">${!! ($service->sale_price > 0) ? '<s class="mr-3">'.$service->price.'</s>' . '$'.$service->sale_price : $service->price !!} per {{ $service->sale_price_type }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection

@section('js')
@endsection
