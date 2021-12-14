@extends('vendor')
@section('title', 'Bookings')

@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Bookings</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Paid</th>
                            <th>Amount</th>
                            <th>Num of Bookings</th>
                            <th>Event/Servive Date</th>
                            <th>Event/Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>
                                    @if($booking->transaction)
                                        Paid at {{ $booking->transaction->created_at->format('d M Y') }}
                                    @else
                                        Not Paid
                                    @endif
                                </td>
                                <td>${{ @$booking->transaction->payment_amount }}</td>
                                <td>{{ $booking->num_of_people ?? 1 }}</td>
                                <td>{{ date('M d, Y', strtotime($booking->booking_date)) }}</td>
                                @if($booking->event)
                                    <td><a href="{{ route('vendor.events.edit', $booking->event->id) }}">{{ $booking->event->title }}</a></td>
                                @else
                                    <td><a href="{{ route('vendor.services.edit', $booking->service->id) }}">{{ $booking->service->title }}</a></td>
                                @endif
                                <td>
                                    <a href="{{ route('vendor.bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
