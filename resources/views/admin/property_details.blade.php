@extends('admin.admin_dashboard')
@section('admin')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Property Details: {{ $property->PName }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Property Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($property->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="Property Image" style="width: 100%; height: auto;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Location:</strong> {{ $property->Address }}</p>
                    <p><strong>Total Units:</strong> {{ $property->Units }}</p>
                    <p><strong>Vacant Units:</strong> {{ $vacantRooms }}</p>
                    <p><strong>Occupied Units:</strong> {{ $occupiedRooms }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
