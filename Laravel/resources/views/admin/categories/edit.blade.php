@extends('admin')
@section('title', 'Edit Category')

@section('css')
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    </div>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
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
                    <form action="{{ route('admin.categories.update', ['id'=>$category->id]) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Type:</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="event" {{ $category->type == 'event' ? 'selected' : '' }}>Event</option>
                                <option value="service" {{ $category->type == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="both" {{ $category->type == 'both' ? 'selected' : '' }}>Both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ $category->status == '1'?'checked':'' }}>
                                <label class="custom-control-label" for="status">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
