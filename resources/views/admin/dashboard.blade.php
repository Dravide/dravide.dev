@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row row-deck row-cards">
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Profile</div>
                </div>
                <div class="h1 mb-3">{{ $profile ? $profile->name : 'Not Set' }}</div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Portfolio Items</div>
                </div>
                <div class="h1 mb-3">{{ $portfolioCount }}</div>
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-primary">
                    <i class="ti ti-briefcase me-1"></i> Manage Portfolio
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Website</div>
                </div>
                <div class="h3 mb-3">
                    <a href="{{ url('/') }}" target="_blank" class="text-decoration-none">
                        <i class="ti ti-external-link me-1"></i> View Live Site
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
