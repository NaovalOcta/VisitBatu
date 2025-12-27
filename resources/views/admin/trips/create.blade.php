@extends('admin.layout')

@section('admin_content')
    <h2 class="h4 text-black mb-4">Add New Trip</h2>

    <div class="bg-white p-4" style="border-radius: 5px;">
        <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="text-black">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-black">Slug (URL)</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-black">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-black">Price (IDR)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-black">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="e.g. 3 Hari 2 Malam"
                        value="{{ old('duration') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="text-black">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="text-black">Thumbnail Image</label>
                <input type="file" name="thumbnail" class="form-control-file">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white py-2 px-4">Save Trip</button>
                <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary py-2 px-4 ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
