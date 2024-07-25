@extends('manager.manager_dashboard')

@section('content')
<div class="container">
    <div class="text-center">
        <h1>Welcome to: {{ $managerAllocation->property->PName }}</h1>
        <h2>Managed by: {{ $manager->Name }}</h2>
    </div>
    <div class="row">
        @foreach($apartmentRooms as $room)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($room->images)
                        <img src="{{ asset('storage/room_images/'.$room->images) }}" class="card-img-top" alt="Room Image">
                    @else
                        <img src="{{ asset('storage/room_images/default.jpg') }}" class="card-img-top" alt="Default Room Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->room_type }} - Room No: {{ $room->room_number }}</h5>
                        <p class="card-text">Charges: KES {{ number_format($room->charges, 2) }}</p>
                        <!-- Add update button with apartment ID and room ID -->
                        <a href="" class="btn btn-primary">Update</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
