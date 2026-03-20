@extends('layouts.admin')

@section('title', 'Edit Portfolio Item')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit: {{ $portfolio->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.portfolio._form', ['portfolio' => $portfolio])
        </form>
    </div>
</div>
@endsection
