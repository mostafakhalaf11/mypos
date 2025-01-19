@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $product->name }}
            {{ $product->price }}
            {{ $product->category->name }}
            {{ $product->description }}
            {{ $product->created_at }}
            {{ $product->updated_at }}
            {{ $product->image }}
        </div>
    </div>
    <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary mt-3">Back to products List</a>
</div>
@endsection
