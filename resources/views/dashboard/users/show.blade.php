@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $user->name }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y') }}</p>
            <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y') }}</p>
        </div>
    </div>
    <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary mt-3">Back to Users List</a>
</div>
@endsection
