<!-- resources/views/manager/manager_index.blade.php -->
@extends('manager.manager_dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manager Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>

<!-- Allocated Apartment Details -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Apartment Details</h5>
                    @if($allocation && $allocation->property)
                        <p><strong>Name:</strong> {{ $allocation->property->PName }}</p>
                        <p><strong>Location:</strong> {{ $allocation->property->Address }}</p>
                        <p><strong>Tenants:</strong> {{ $allocation->property->tenants->count() }}</p>
                        <p><strong>Status:</strong> {{ $allocation->property->status }}</p>
                    @else
                        <p>No allocated apartment details available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Summary Boxes -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Number of Tenants</h5>
                <p class="card-text">{{ $allocation->property->tenants->count() ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vacant Houses</h5>
                <p class="card-text">{{ $allocation->property->vacant_houses ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text">{{ $allocation->property->reports ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Complaints</h5>
                <p class="card-text">{{ $allocation->property->complaints ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Allocated Apartment Details Table -->
<div class="table-responsive mt-4">
    <h3>Allocated Apartment Details</h3>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Apartment</th>
                <th>Location</th>
                <th>Tenants</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($allocation && $allocation->property)
                <tr>
                    <td>1</td>
                    <td>{{ $allocation->property->PName }}</td>
                    <td>{{ $allocation->property->Address }}</td>
                    <td>{{ $allocation->property->tenants->count() }}</td>
                    <td>{{ $allocation->property->status }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">View</button>
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="6">No allocated apartment details available.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Additional Dashboard Content Goes Here -->
@endsection
