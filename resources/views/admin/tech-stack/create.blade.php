@extends('layouts.admin')

@section('title', 'Add Tech Stack Item')

@section('header', 'Add Tech')

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">New Tech Item</h3>
        </div>
        <form action="{{ route('admin.tech-stack.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Order</label>
                            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}" required>
                            @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Icon (Tabler Icon class, e.g. `ti ti-brand-laravel`)</label>
                            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}">
                            @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Icon Color</label>
                            <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', '#666666') }}" title="Choose your color">
                            @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }}>
                        <span class="form-check-label">Show on homepage</span>
                    </label>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.tech-stack.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Item</button>
            </div>
        </form>
    </div>
</div>
@endsection
