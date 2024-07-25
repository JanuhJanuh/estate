@extends('admin.admin_dashboard')

@section('admin')

<!-- Content Header (Page header) -->

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->

        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Quick Links</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="content-header">

<div class="row mt-4">
    <!-- Summary Boxes -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Apartments</h5>
                <p class="card-text">{{ $allocation->property->tenants ?? 'N/A' }}</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Number of Tenants</h5>
                <p class="card-text">{{ $allocation->property->tenants ?? 'N/A' }}</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rent Payments</h5>
                <p class="card-text">Plus Invoice</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vacant Houses</h5>
                <p class="card-text">yu</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text">{{ $allocation->property->reports ?? 'N/A' }}</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Complaints</h5>
                <p class="card-text">{{ $allocation->property->complaints ?? 'N/A' }}</p>
                <a href="#" class="btn btn-sm btn-info">View More</a>
            </div>
        </div>
    </div>
</div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection
