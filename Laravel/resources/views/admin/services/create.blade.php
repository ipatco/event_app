@extends('admin')
@section('title', 'Add New Service')

@section('css')
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Service</h1>
        <a href="{{ route('admin.services') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Back
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Services</h6>
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
            <form action="{{ route('admin.services.save') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                    <label for="price">Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price') }}" required>
                        <div class="input-group-append">
                            <select class="custom-select" id="sale_price_type" name="sale_price_type" required>
                                <option value="Unit Price Per Day" {{ old('sale_price_type') == 'Unit Price Per Day' ? 'selected' : '' }}>Unit Price Per Day</option>
                                {{-- <option value="day" {{ old('sale_price_type') == 'day' ? 'selected' : '' }}>per Day</option>
                                <option value="item per day" {{ old('sale_price_type') == 'item per day' ? 'selected' : '' }}>per Item per day</option>
                                <option value="person" {{ old('sale_price_type') == 'person' ? 'selected' : '' }}>per Person</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sale_price">Discounted Price </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Discounted Price " value="{{ old('sale_price') }}">
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
                    <input type="file" class="form-control" id="image" name="image">
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
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
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
