@extends('layouts.admin')

@section('title', 'Portfolio')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Portfolio Items</h3>
        <div class="card-actions">
            <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add New
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th style="width: 50px">Order</th>
                    <th style="width: 80px">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Visibility</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portfolios as $portfolio)
                <tr>
                    <td class="text-muted">{{ $portfolio->sort_order }}</td>
                    <td>
                        @if($portfolio->image)
                            <span class="avatar avatar-md" style="background-image: url({{ Storage::url($portfolio->image) }})"></span>
                        @else
                            <span class="avatar avatar-md bg-secondary-lt"><i class="ti ti-photo"></i></span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold">{{ $portfolio->title }}</div>
                        <div class="text-muted small">{{ Str::limit($portfolio->description, 60) }}</div>
                    </td>
                    <td>
                        @if($portfolio->category)
                            <span class="badge bg-secondary-lt">{{ $portfolio->category }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($portfolio->is_visible)
                            <span class="badge bg-success-lt">Visible</span>
                        @else
                            <span class="badge bg-secondary-lt">Hidden</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-list">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="ti ti-briefcase-off mb-2" style="font-size: 2rem;"></i>
                        <p>No portfolio items yet. <a href="{{ route('admin.portfolios.create') }}">Create your first one</a>.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
