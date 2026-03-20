@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3 class="card-title">All Posts</h3>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus me-1"></i> New Post
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th class="w-1">Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th class="w-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>
                        @if($post->image)
                            <span class="avatar avatar-md" style="background-image: url({{ Storage::url($post->image) }})"></span>
                        @else
                            <span class="avatar avatar-md text-muted"><i class="ti ti-photo"></i></span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold">{{ $post->title }}</div>
                        <div class="text-muted small">{{ $post->slug }}</div>
                    </td>
                    <td>
                        @if($post->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td class="text-muted">
                        {{ $post->published_at ? $post->published_at->format('M d, Y') : '—' }}
                    </td>
                    <td>
                        <div class="btn-list flex-nowrap">
                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-white">
                                Edit
                            </a>
                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
