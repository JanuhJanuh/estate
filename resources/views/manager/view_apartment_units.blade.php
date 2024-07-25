@extends('manager.manager_dashboard')

@section('content')
<div class="container">
    <h1>Apartment Rooms</h1>
    <div class="row">
        @foreach($apartmentRooms as $room)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($room->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="card-img-top" alt="Room Image">
                    @else
                        <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Room Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->room_type }} - Room No: {{ $room->room_number }}</h5>
                        <p class="card-text">Charges: KES {{ number_format($room->charges, 2) }}</p>
                        <form action="{{ route('manager.roomcheck_in', ['tenant_id' => $tenant->id, 'room_id' => $room->id, 'apartment_id' => $managerAllocation->apartment_id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="apartment_id" value="{{ $managerAllocation->apartment_id }}">
                            <button type="submit" class="btn btn-primary">Check In</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-body {
    background-color: #f8f9fa;
    padding: 15px;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
}

.card-text {
    font-size: 14px;
    color: #6c757d;
}
</style>
@endsection
