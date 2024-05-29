@extends('admin.admin_dashboard')

@section('admin')
    <div class="content-wrapper">
        <div class="container register mt-3">
            <div class="row">
                <div class="col-md-3 register-left">
                    <h3>{{ $manager->Name }}</h3>
                    <div class="form-group">
                        @if($manager->Image)
                            <img src="{{ asset('storage/' . $manager->Image) }}" alt="Manager Image" class="img-fluid rounded-circle">
                        @else
                            <p class="text-muted">No Image Available</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 register-right">
                    <h3 class="register-heading">Manager Details</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name:</label>
                                <p>{{ $manager->Name }}</p>
                            </div>
                            <div class="form-group">
                                <label>ID:</label>
                                <p>{{ $manager->IDNumber }}</p>
                            </div>
                            <div class="form-group">
                                <label>Date of Birth:</label>
                                <p>{{ $manager->DOB }}</p>
                            </div>
                            <div class="form-group">
                                <label>Gender:</label>
                                <p>{{ $manager->Gender }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <p>{{ $manager->Email }}</p>
                            </div>
                            <div class="form-group">
                                <label>Phone Number:</label>
                                <p>{{ $manager->PhoneNo }}</p>
                            </div>
                            <div class="form-group">
                                <label>Address:</label>
                                <p>{{ $manager->Address }}</p>
                            </div>
                        </div>
                    </div>
                    <h3 class="register-heading">Allocated Apartment</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apartment Name:</label>
                                @if($allocation)
                                    <p>{{ $allocation->Property->PName }}</p>
                                @else
                                    <p class="text-muted">Not Allocated</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status:</label>
                                @if($allocation)
                                    <p>{{ $allocation->status }}</p>
                                @else
                                    <p class="text-muted">Not Active</p>
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
