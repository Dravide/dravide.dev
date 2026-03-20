@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Profile Information</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title / Role</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $profile->title) }}" placeholder="e.g. Full Stack Developer">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" rows="5" placeholder="Tell about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $profile->email) }}" placeholder="hello@dravide.dev">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        @if($profile->avatar)
                            <div class="mb-2">
                                <img src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="rounded" style="max-width: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="avatar" accept="image/*">
                    </div>
                </div>
            </div>

            <hr>
            <h3 class="mb-3">Social Links</h3>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-github me-1"></i> GitHub URL
                        </label>
                        <input type="url" class="form-control" name="github_url" value="{{ old('github_url', $profile->github_url) }}" placeholder="https://github.com/username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-linkedin me-1"></i> LinkedIn URL
                        </label>
                        <input type="url" class="form-control" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-twitter me-1"></i> Twitter URL
                        </label>
                        <input type="url" class="form-control" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" placeholder="https://twitter.com/username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-instagram me-1"></i> Instagram URL
                        </label>
                        <input type="url" class="form-control" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" placeholder="https://instagram.com/username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-youtube me-1"></i> YouTube URL
                        </label>
                        <input type="url" class="form-control" name="youtube_url" value="{{ old('youtube_url', $profile->youtube_url) }}" placeholder="https://youtube.com/@channel">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-facebook me-1"></i> Facebook URL
                        </label>
                        <input type="url" class="form-control" name="facebook_url" value="{{ old('facebook_url', $profile->facebook_url) }}" placeholder="https://facebook.com/username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-brand-whatsapp me-1"></i> WhatsApp Number
                        </label>
                        <input type="text" class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number', $profile->whatsapp_number) }}" placeholder="e.g. 628123456789">
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Save Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
