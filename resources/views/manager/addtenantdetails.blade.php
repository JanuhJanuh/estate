@extends('manager.manager_dashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow">
                <div class="card-header text-white text-center" style="background-color: #bbeefa;">
                    <h4>Register New Tenant</h4>
                </div>
                <div class="card-body">
                    <!-- Success and error messages -->
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Tenant Form -->
                    <form method="POST" action="{{ route('manager.savetenant') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Tenant Details -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tenant Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input
                                        type="text"
                                        name="id_number"
                                        class="form-control @error('id_number') is-invalid @enderror"
                                        id="id_number"
                                        value="{{ old('id_number') }}"
                                        required>
                                    @error('id_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        value="{{ old('phone') }}"
                                        required>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select
                                        name="gender"
                                        class="form-control @error('gender') is-invalid @enderror"
                                        id="gender"
                                        required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                        <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Apartment and Room Details -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_id">Select Room</label>
                                    <select
                                        name="room_id"
                                        class="form-control @error('room_id') is-invalid @enderror"
                                        id="room_id"
                                        required>
                                        <option value="">Select a Vacant Room</option>
                                        @forelse($vacantRooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }}, {{ $room->charges }}</option>
                                        @empty
                                            <option value="">No vacant rooms available</option>
                                        @endforelse
                                    </select>
                                    @error('room_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input
                                        type="date"
                                        name="entry_date"
                                        class="form-control @error('entry_date') is-invalid @enderror"
                                        id="entry_date"
                                        value="{{ old('entry_date') }}"
                                        required>
                                    @error('entry_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_image">ID Image</label>
                                    <input
                                        type="file"
                                        name="id_image"
                                        class="form-control @error('id_image') is-invalid @enderror"
                                        id="id_image"
                                        accept="image/*"
                                        required>
                                    @error('id_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">Register Tenant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
