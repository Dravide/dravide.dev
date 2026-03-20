@extends('layouts.admin')

@section('title', 'Manage Tech Stack')

@section('header', 'Tech Stack')

@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Tech Stack Items</h3>
        <a href="{{ route('admin.tech-stack.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus me-1"></i> Add New
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th class="w-1">Order</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Color</th>
                    <th>Visibility</th>
                    <th class="w-1"></th>
                    <th class="w-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($techStacks as $tech)
                <tr data-id="{{ $tech->id }}">
                    <td class="text-muted">{{ $tech->sort_order }}</td>
                    <td>{{ $tech->name }}</td>
                    <td class="text-muted">
                        @if($tech->icon)
                            <i class="{{ $tech->icon }} me-1"></i> {{ $tech->icon }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($tech->color)
                            <span class="avatar avatar-xs rounded-circle" style="background-color: {{ $tech->color }}"></span>
                            <span class="ms-1">{{ $tech->color }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($tech->is_visible)
                            <span class="badge bg-success">Visible</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="cursor-move drag-handle text-muted">
                            <i class="ti ti-selector"></i>
                        </div>
                    </td>
                    <td>
                        <div class="btn-list flex-nowrap">
                            <a href="{{ route('admin.tech-stack.edit', $tech) }}" class="btn btn-sm btn-white">
                                Edit
                            </a>
                            <form action="{{ route('admin.tech-stack.destroy', $tech) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                    <td colspan="6" class="text-center py-5">
                        <div class="empty">
                            <div class="empty-icon">
                                <i class="ti ti-ghost text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <p class="empty-title">No tech stack items yet.</p>
                            <div class="empty-action">
                                <a href="{{ route('admin.tech-stack.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i> Create your first one.
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.querySelector('table tbody');
        const sortable = Sortable.create(el, {
            handle: '.drag-handle',
            animation: 150,
            onEnd: function (evt) {
                const ids = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
                
                fetch('{{ route("admin.tech-stack.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optional: show a small toast or update numbers
                        console.log('Order updated');
                    }
                });
            }
        });
    });
</script>
@endsection
