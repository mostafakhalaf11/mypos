@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Client Details</h1>
    <div class="card">
        <div class="card-header">
           <li>{{ $client->name }}</li>
           <li>{{ $client->address }}</li>
           <li>{{ $client->phone[0] }}</li>
        </div>
    </div>
    <a href="{{ route('dashboard.clients.index') }}" class="btn btn-primary mt-3">Back to clients List</a>
</div>
@endsection
