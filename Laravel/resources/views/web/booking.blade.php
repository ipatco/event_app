@extends('web')
@section('title', 'Booking')

@section('css')
@endsection

@section('page')
    <div class="row">

        <div class="offset-md-3 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    @if($type == 's')
                    <h6 class="m-0 font-weight-bold text-primary">Book "{{ $title }}" for ${{ $price }} per {{ $time }}</h6>
                    @elseif($type == 'e')
                    <h6 class="m-0 font-weight-bold text-primary">Book "{{ $title }}" for ${{ $price }} per people/person</h6>
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
                    <form action="{{ route('booking.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($service == 1)
                            <input type="hidden" name="service_id" value="{{ $id }}">
                        @endif
                        @if ($event == 1)
                            <div class="form-group">
                                <label for="num_of_people">Number of Person</label>
                                <select name="num_of_people" id="num_of_people" class="form-control">
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <input type="hidden" name="event_id" value="{{ $id }}">
                        @endif
                        <input type="hidden" name="user_id" value="{{ $user }}">
                        <input type="hidden" name="vendor_id" value="{{ $vendor }}">
                        <div class="form-group">
                            <label for="booking_date">Booking Date</label>
                            <input type="text" name="booking_date" id="booking_date" class="form-control dated" value="{{ old('booking_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Your Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <input type="submit" value="Book and Pay" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@php
    if($event == 1) {
        $start_date = date('Y-m-d', strtotime($eve->start_date));
        if($start_date < date('Y-m-d')) {
            $start_date = date('Y-m-d');
        }
        $end_date = date('Y-m-d', strtotime($eve->end_date));
    }
@endphp
<script>
    $('.dated').datepicker({
        autoHide: true,
        zIndex: 2048,
        format: 'yyyy-mm-dd',
        @if($event == 1)
            startDate: '{{ $start_date }}',
            endDate: '{{ $end_date }}',
        @endif
        autoPick: true
    });
</script>
@endsection
