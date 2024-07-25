@extends('manager.manager_dashboard')

@section('content')
<div class="container">
    <h2>Allocate Room</h2>
    <div class="card">
        <div class="card-header">
            <h3>Apartment: {{ $apartment->PName }}</h3>
            <h4>Manager: {{ $manager->Name }}</h4>
            <h5>Tenant: {{ $tenant->Name }}</h5>
        </div>
        <div class="card-body">
            <!-- Display error messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display session error messages -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('manager.roomcheck_in') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="roomSelect">Available Rooms:</label>
                    <select class="form-control" id="roomSelect" name="room_id">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }} - {{ $room->charges }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="entryDate">Entry Date:</label>
                    <input type="date" class="form-control" id="entryDate" name="entry_date" min="{{ date('Y-m-d') }}" required>
                </div>
                <hr>
                <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                <button type="submit" class="btn btn-primary">Confirm Allocation</button>
            </form>
        </div>
    </div>
</div>
@endsection
