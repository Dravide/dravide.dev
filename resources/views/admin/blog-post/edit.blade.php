@extends('layouts.admin')

@section('title', 'Edit Post: ' . $blogPost->title)

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.blog-post._form')
        </form>
    </div>
</div>
@endsection
