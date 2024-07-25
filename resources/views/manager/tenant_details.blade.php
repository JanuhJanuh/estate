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

    <div class="card">
        <div class="card-header">
            <h2>Tenant Details</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <img src="{{ asset('tenant_images/' . $tenant->IDImage) }}" alt="ID Image" width="100%">
                </div>
                <div class="col-md-9">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $tenant->Name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>ID Number:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $tenant->IDNumber }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $tenant->Phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $tenant->Email }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Gender:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $tenant->Gender }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if($tenant->apartment)
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Apartment Name:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->apartment->PName }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Apartment Address:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->apartment->Address }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Description:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->apartment->Description }}
                </div>
            </div>
            @else
            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>No apartment information available.</strong>
                </div>
            </div>
            @endif
            <hr>
            @if($tenant->booking && $tenant->booking->room)
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Room Number:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->booking->room->room_number }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Room Type:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->booking->room->room_type }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Entry Date:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->booking->entry_date }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Charges:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->booking->room->charges }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Status:</strong>
                </div>
                <div class="col-md-8">
                    {{ $tenant->booking->status }}
                </div>
            </div>
            @else
            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>No room information available.</strong>
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('manager.update_tenant', $tenant->id) }}" class="btn btn-primary">Edit Tenant</a>
            <a href="{{ route('manager.allocate_room', ['tenant_id' => $tenant->id]) }}" class="btn btn-secondary">Allocate Room</a>
            <a href="{{ route('manager.dashboard') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
