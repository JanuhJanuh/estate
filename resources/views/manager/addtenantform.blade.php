@extends('manager.manager_dashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Register New Tenant</h4>
                </div>
                <div class="card-body">
                    <div id="alert-success" class="alert alert-success d-none"></div>
                    <div id="alert-errors" class="alert alert-danger d-none">
                        <ul id="error-list"></ul>
                    </div>

                    <!-- Display success message -->
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display error message -->
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="tenant-form" method="POST" action="{{ route('manager.savetenant') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="number" name="id_number" class="form-control" id="id_number" required value="{{ old('id_number') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" required value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                                <option value="Other" @if(old('gender') == 'Other') selected @endif>Other</option>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="id_image">ID Image</label>
                            <input type="file" name="id_image" class="form-control-file" id="id_image" accept="image/*" required>
                        </div>
                        <hr>

                        <button type="submit" class="btn btn-primary">Register Tenant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
