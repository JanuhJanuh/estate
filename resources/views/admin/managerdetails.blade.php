@extends('admin.admin_dashboard')

@section('admin')
<div class="content-wrapper">
    <div class="container register" style="padding-top: 50px;">
        <div class="row">
            <div class="col-md-3 register-left">
                <h3>{{ $manager->Name }}</h3>

<div class="form-group">
    @if($manager->Image)
        <img src="{{ asset('storage/manager_images/' . $manager->Image) }}" alt="Manager Image"/>
    @else
        <p>No Image Available</p>
    @endif
</div>


<div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-responsive">
                                <img src="{{ asset('storage/manager_images/' . $manager->Image) }} }}" class="img-fluid">
                                <h3 class="mt-4 pink-text center"></h3>
                                <p class=" center">{{ $manager->Name}}</p>
                                <hr>

                               <div class="text-center">
                                    <a href="#}" class="btn btn-block pink darken-1 white-text">More info</a>

                               </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-9 register-right">
                <h3 class="register-heading">Manager Details</h3>
                <div class="row register-form">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <div class="form-group">
                            <label>{{ $manager->Name }}</label>
                        </div>
                        <label for="id">ID</label>
                        <div class="form-group">
                            <label>{{ $manager->IDNumber }}</label>
                        </div>
                        <label for="dob">Date of Birth</label>
                        <div class="form-group">
                            <label>{{ $manager->DOB }}</label>
                        </div>
                        <label for="gender">Gender</label>
                        <div class="form-group">
                            <label>{{ $manager->Gender }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <div class="form-group">
                            <label>{{ $manager->Email }}</label>
                        </div>
                        <label for="email">Email</label>
                        <div class="form-group">
                            <label>{{  $manager->Email }}</label>
                        </div>
                        <label for="phone">Phone Number</label>
                        <div class="form-group">
                            <label>{{ $manager->PhoneNo }}</label>
                        </div>
                        <label for="address">Address</label>
                        <div class="form-group">
                            <label>{{ $manager->Address }}</label>
                        </div>
                    </div>
                </div>
                <h3 class="register-heading">Allocated Apartment</h3>
                <div class="row register-form">
                    <div class="col-md-6">
                        <label for="apartment-name">Apartment Name</label>
                        <div class="form-group">
                            @if($allocation)
                                <label>{{ $allocation->Property->PName }}</label>
                            @else
                                <label>Not Allocated</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <div class="form-group">
                            @if($allocation)
                                <label>{{ $allocation->status }}</label>
                            @else
                                <label>Not Active</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@endpush
