@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $category->name }}
        </div>
    </div>
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary mt-3">Back to categoriess List</a>
</div>
@endsection
