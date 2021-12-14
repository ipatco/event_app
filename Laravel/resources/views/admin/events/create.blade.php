@extends('admin')
@section('title', 'Add New Event')

@section('css')
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Event</h1>
        <a href="{{ route('admin.events') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Back
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Events</h6>
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
            <form action="{{ route('admin.events.save') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control start-date" id="start_date" name="start_date" value="{{ old('start_date') }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control end-date" id="end_date" name="end_date" value="{{ old('end_date') }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="location">Full Venue Location</label>
                    <textarea class="form-control" id="location" name="location" rows="3" minlength="10" required>{{ old('location') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price per person</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price per person" value="{{ old('price') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sale_price">Discounted Price per person</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Discounted Price per person" value="{{ old('sale_price') }}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="video">Video</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                        </div>
                        <input type="text" class="form-control" id="video" name="video" placeholder="Video ID" value="{{ old('video') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select Category</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"  {{ old('category') == $category->id?'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="organizer_name">Organizer Name</label>
                    <input type="text" class="form-control" id="organizer_name" name="organizer_name" placeholder="Organizer Name"  value="{{ old('organizer_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="organizer_phone">Organizer Phone</label>
                    <input type="text" class="form-control" id="organizer_phone" name="organizer_phone" placeholder="Organizer Phone"  value="{{ old('organizer_phone') }}" required>
                </div>
                <div class="form-group">
                    <label for="organizer_email">Organizer Email</label>
                    <input type="text" class="form-control" id="organizer_email" name="organizer_email" placeholder="Organizer Email"  value="{{ old('organizer_email') }}" required>
                </div>
                <div class="form-group">
                    <label for="organizer_website">Organizer Website(http://example.com/)</label>
                    <input type="text" class="form-control" id="organizer_website" name="organizer_website" placeholder="Organizer Website"  value="{{ old('organizer_website') }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Display Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" {{ old('status') == '1'?'selected':'' }}>Active</option>
                        <option value="0" {{ old('status') == '0'?'selected':'' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="booking_status">Booking Status</label>
                    <select class="form-control" id="booking_status" name="booking_status">
                        <option value="1" {{ old('booking_status') == 1 ? 'selected' : '' }}>Allow</option>
                        <option value="0" {{ old('booking_status') == 0 ? 'selected' : '' }}>Block</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
