@extends('admin.admin_dashboard')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Properties</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Property Details</h5>
                    <div class="card-tools">
                        <a class="btn btn-success" href="{{ route('admin.addproperty') }}">Add Property</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property Image</th>
                                    <th>Property Name</th>
                                    <th>Location</th>
                                    <th>Units</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $Property)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($Property->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $Property->images->first()->image_path) }}" alt="Property Image" style="width: 100px; height: auto;">

                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $Property->PName }}</td>
                                    <td>{{ $Property->Address }}</td>
                                    <td>{{ $Property->Units }}</td>
                                    <td>
                                        <form action="{{ route('admin.deleteproperty', $Property->id) }}" method="POST">
                                            <a class="btn btn-success" href="{{ route('admin.property_details', $Property->id) }}">View</a>
                                            <a class="btn btn-primary" href="{{ route('admin.editproperty', $Property->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div><!--/. container-fluid -->
@endsection
