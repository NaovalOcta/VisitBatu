@extends('admin.layout')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-black m-0">Trips List</h2>
        <a href="{{ route('admin.trips.create') }}" class="btn btn-primary text-white btn-sm py-2 px-3 rounded-0">Add New
            Trip</a>
    </div>

    <div class="bg-white p-4 table-responsive" style="border-radius: 5px;">
        <table class="table table-bordered table-hover">
            <thead class="bg-light">
                <tr>
                    <th>Image</th>
                    <th>Trip Name</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trips as $trip)
                    <tr>
                        <td>
                            @if ($trip->thumbnail)
                                <img src="{{ asset('storage/' . $trip->thumbnail) }}" alt="img"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $trip->title }}</strong><br>
                            <small class="text-muted">{{ $trip->duration }}</small>
                        </td>
                        <td>Rp {{ number_format($trip->price, 0, ',', '.') }}</td>
                        <td>{{ $trip->location }}</td>
                        <td>
                            <a href="{{ route('admin.trips.edit', $trip->id) }}"
                                class="btn btn-warning btn-sm text-white"><span class="icon-pencil"></span></a>

                            <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><span
                                        class="icon-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No trips available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $trips->links() }}
        </div>
    </div>
@endsection
