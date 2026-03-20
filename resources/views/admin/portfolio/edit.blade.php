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

@if(isset($portfolio) && $portfolio->exists)
    @foreach($portfolio->images as $img)
        <form id="delete-img-{{ $img->id }}" action="{{ route('admin.portfolios.delete-image', $img) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
    @if($portfolio->image)
        <form id="delete-main-img" action="{{ route('admin.portfolios.delete-main-image', $portfolio) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endif
@endsection
