@extends('manager.manager_dashboard')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Tenants</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID Number</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>ID Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
            <tr>
            <td>{{ $tenant->Name}} </td>
        <td>
            <!-- Display ID Image -->
            <img src="{{ asset('tenant_images/' . $tenant->IDImage) }}" alt="ID Image" width="50">
            {{ $tenant->IDNumber }}
        </td>
                <td>{{ $tenant->Phone }}</td>
                <td>{{ $tenant->Gender }}</td>

                <td>
                    @if($tenant->booking && $tenant->booking->room)
                        <span class="btn btn-info">Room: {{ $tenant->booking->room->room_number }}</span>
                    @else
                        <a href="{{ route('manager.allocate_room', ['tenant_id' => $tenant->id]) }}" class="btn btn-warning">Allocate Room</a>
                    @endif
                    <a href="{{ route('manager.tenant_details', $tenant->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('manager.update_tenant', $tenant->id) }}" class="btn btn-secondary">Update</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
