@extends('admin.layout')

@section('admin_content')
    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-white text-center" style="border-radius: 5px;">
                <span class="icon-plane display-4 text-primary mb-3 d-block"></span>
                <h3 class="h5 text-black">Total Trips</h3>
                <p class="display-4 font-weight-bold text-primary">{{ $totalTrips }}</p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-white text-center" style="border-radius: 5px;">
                <span class="icon-pencil display-4 text-warning mb-3 d-block"></span>
                <h3 class="h5 text-black">Pending Posts</h3>
                <p class="display-4 font-weight-bold text-warning">{{ $pendingPosts }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4" style="border-radius: 5px;">
        <h3 class="h5 text-black mb-3">Needs Approval</h3>
        @if ($moderationQueue->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moderationQueue as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name ?? 'Unknown' }}</td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td><a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-primary">Review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No pending posts.</p>
        @endif
    </div>
@endsection
