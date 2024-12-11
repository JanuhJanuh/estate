@extends('admin.admin_dashboard')

@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Allocate Manager to Apartment</h1>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manager Details</h5>
                            <p><strong>Name:</strong> {{ $Manager->Name }}</p>
                            <p><strong>Gender:</strong> {{ $Manager->Gender }}</p>
                            <p><strong>Email:</strong> {{ $Manager->PhoneNo }}</p>
                            <!-- Display other manager details as needed -->

                            <h5 class="card-title">Select Apartment</h5>
                            <!-- Check if there are properties available -->
                            @if($Property->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    No apartments available for allocation.
                                </div>
                            @else
                            <form action="{{ route('admin.saveallocatemanager', ['managerid' => $Manager->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="manager_id" value="{{ $Manager->id }}">

                                <div class="form-group">
                                    <label for="apartment_id">Choose an Apartment:</label>
                                    <select name="apartment_id" id="apartment_id" class="form-control" required>
                                        @foreach($Property as $apartment)
                                            <option value="{{ $apartment->id }}">{{ $apartment->PName }} - {{ $apartment->Address }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" min="{{ date('Y-m-d') }}">
                                </div>

                                <div class="form-group">
                                    <label for="salary">Salary:</label>
                                    <input type="number" name="salary" id="salary" class="form-control" min="0" step="0.01">
                                </div>

                                <button type="submit" class="btn btn-primary">Allocate</button>
                            </form>


                            @endif

                            <!-- Success message -->
                            @if(session('success'))
                                <div class="alert alert-success mt-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Error message -->
                            @if(session('error'))
                                <div class="alert alert-danger mt-3" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
