@extends('admin.layout')

@section('admin_content')
<h2 class="h4 text-black mb-4">Blog Moderation</h2>

<div class="bg-white p-4 table-responsive" style="border-radius: 5px;">
    <table class="table table-bordered">
        <thead class="bg-light">
            <tr>
                <th>Post Details</th>
                <th>Author</th>
                <th>Status</th>
                <th style="width: 200px;">Moderation</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    <h5 class="h6 mb-1 text-black">{{ $post->title }}</h5>
                    <p class="small text-muted mb-1">{{ Str::limit($post->content, 80) }}</p>
                    <small class="text-secondary">Submitted: {{ $post->created_at->diffForHumans() }}</small>
                </td>
                <td>{{ $post->user->name }}</td>
                <td>
                    @if($post->status == 'pending')
                        <span class="badge badge-warning text-white">Pending</span>
                    @elseif($post->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @else
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    @if($post->status == 'pending')
                    <div class="d-flex">
                        <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="mr-1">
                            @csrf @method('PATCH')
                            <button class="btn btn-success btn-sm btn-block" title="Approve">
                                <span class="icon-check"></span> Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="btn btn-outline-danger btn-sm btn-block" title="Reject">
                                <span class="icon-close"></span> Reject
                            </button>
                        </form>
                    </div>
                    @else
                        <span class="text-muted small">Processed</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No posts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
</div>
@endsection
