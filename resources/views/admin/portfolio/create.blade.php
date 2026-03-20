@extends('layouts.admin')

@section('title', 'Add Portfolio Item')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">New Portfolio Item</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.portfolio._form')
        </form>
    </div>
</div>
@endsection
