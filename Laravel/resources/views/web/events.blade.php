@extends('web')
@section('title', 'Events')

@section('css')
@endsection

@section('page')

@if (count($events) > 0)
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
    <h1 class="h3 mb-0 text-gray-800">Events</h1>
</div>
<div class="row">
    {{-- Events --}}
    @foreach ($events as $event)
    <div class="col-xl-3 col-lg-3">
        <div class="card shadow mb-4">
            <img class="img-fluid m-3 imgg" src="{{ asset('uploads/events/'.$event->image) }}" alt="">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $event->title }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">${!! ($event->sale_price > 0) ? '<s class="mr-3">'.$event->price.'</s>' . '$'.$event->sale_price : $event->price !!} per Ticket</div>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('event.detail', $event->slug) }}" class="btn btn-primary">Detail</a>
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
