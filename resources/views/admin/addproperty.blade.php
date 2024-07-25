@extends('admin.admin_dashboard')

@section('admin')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Property</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add New Property</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Property Details</h3>
                                    </div>
                                    <form action="{{ route('admin.saveproperty') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="PName">Property Name:</label>
                                                <input type="text" name="PName" class="form-control" id="PName" placeholder="Property Name" value="{{ old('PName') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="PropertyType">Property Type:</label>
                                                <select name="PropertyType" class="form-control" id="PropertyType" required>
                                                    <option value="" disabled {{ old('PropertyType') ? '' : 'selected' }}>Select Property Type</option>
                                                    <option value="Apartment" {{ old('PropertyType') == 'Apartment' ? 'selected' : '' }}>Apartment - Self Contained Housing Units</option>
                                                    <option value="House" {{ old('PropertyType') == 'House' ? 'selected' : '' }}>House - A standalone residential Home</option>
                                                    <option value="oneB" {{ old('PropertyType') == 'oneB' ? 'selected' : '' }}>One/Two Bedroom Units</option>
                                                    <option value="Studio" {{ old('PropertyType') == 'Studio' ? 'selected' : '' }}>Studio - Bedsitters</option>
                                                    <option value="Self-contained Room" {{ old('PropertyType') == 'Self-contained Room' ? 'selected' : '' }}>Self-contained Room - Single room with Basic facilities</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="Address">Address:</label>
                                                <input type="text" name="Address" class="form-control" id="Address" placeholder="Location" value="{{ old('Address') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Description">Description:</label>
                                                <textarea name="Description" class="form-control" id="Description" rows="4" placeholder="Property Description 4 rows max" required>{{ old('Description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="Units">Total Units:</label>
                                                <input type="number" name="Units" class="form-control" id="Units" placeholder="Total Units" value="{{ old('Units') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Images">Property Images:</label>
                                                <input type="file" name="Images[]" class="form-control-file" id="Images" multiple required>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
