@extends('layouts.admin')

@section('title', 'New Blog Post')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.blog-post._form')
        </form>
    </div>
</div>
@endsection
