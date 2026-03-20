@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="row row-cards">
    <div class="col-md-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            <div class="card-header">
                <h3 class="card-title">General Settings</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Site Logo / Icon</label>
                    @if(isset($settings['site_logo']))
                        <div class="mb-3">
                            <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo" class="rounded border" style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="site_logo" accept="image/*">
                    <small class="text-muted italic">Recommended size: 512x512px</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Favicon</label>
                    @if(isset($settings['site_favicon']))
                        <div class="mb-3">
                            <img src="{{ Storage::url($settings['site_favicon']) }}" alt="Favicon" class="rounded border" style="width: 32px; height: 32px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="site_favicon" accept="image/*">
                    <small class="text-muted italic">Recommended: .ico or .png, 32x32px</small>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
