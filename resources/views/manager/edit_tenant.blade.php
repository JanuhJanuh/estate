@extends('manager.manager_dashboard')

@section('content')
<div class="container">
    <h2>Edit Tenant</h2>
    <form action="{{ route('manager.update_tenant', $tenant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tenant->Name }}" required>
        </div>
        <div class="form-group">
            <label for="id_number">ID Number</label>
            <input type="text" name="id_number" class="form-control" value="{{ $tenant->IDNumber }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $tenant->Phone }}" required>
        </div>
        <div class="form-group">
            <label for="phone2">Phone2</label>
            <input type="text" name="phone2" class="form-control" value="{{ $tenant->Phone2 }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $tenant->Email }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $tenant->Gender }}" required>
        </div>
        <div class="form-group">
            <label for="id_image">ID Image</label>
            <input type="file" name="id_image" class="form-control">
            <img src="{{ asset('tenant_images/' . $tenant->IDImage) }}" alt="ID Image" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update Tenant</button>
    </form>
</div>
@endsection
