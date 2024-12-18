@extends('admin.admin_dashboard')
@section('admin')

<div class="container mt-4">
    <h1>Tenants Management</h1>

    <!-- Apartment Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.viewtenantsdata') }}">
                <div class="input-group">
                    <select class="form-select" name="property_id" onchange="this.form.submit()">
                        <option value="">-- View All Tenants --</option>
                        @foreach($properties as $apartment)
                        <option value="{{ $apartment->id }}" {{ request('property_id') == $apartment->id ? 'selected' : '' }}>
                            {{ $apartment->PName }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Tenants Table -->
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Phone</th>
                        <th>Apartment</th>
                        <th>Room</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($tenants as $tenant)
    <tr>
        <td>{{ $tenant->Name}} </td>
        <td>
            <!-- Display ID Image -->
            <img src="{{ asset('tenant_images/' . $tenant->IDImage) }}" alt="ID Image" width="50">
            {{ $tenant->IDNumber }}
        </td>
        <td>{{ $tenant->Phone }}</td>
        <td>{{ $tenant->booking->apartment->PName ?? 'N/A' }}</td>
        <td>{{ $tenant->booking->room->room_number ?? 'N/A' }}</td>
        <td>
            <!-- Example Action Buttons -->
            <a href="#" class="btn btn-primary btn-sm">Edit</a>
            <a href="#" class="btn btn-success btn-sm">Check</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center">No tenants found in the selected apartment</td>
    </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>
</div>

@endsection
