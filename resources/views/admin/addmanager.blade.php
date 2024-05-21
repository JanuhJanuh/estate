@extends('admin.admin_dashboard')

@section('admin')
<div class="content-wrapper">
    <div class="container register" style="padding-top: 50px;">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="#" alt=""/>
                <h3>Kyeni Estates</h3>
                <p>Add Apartment Managers</p>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Manager</a>
                    </li>
                    <!-- Removed Worker tab -->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Register as an Apartment Manager</h3>
                        @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                        <form method="POST" action="{{ route('admin.savemanager') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <label for="name">Name *</label>
                                    <div class="form-group">
                                        <input type="text" id="name" name="Name" class="form-control" placeholder="Name *" value="" />
                                    </div>
                                    <label for="id">ID *</label>
                                    <div class="form-group">
                                        <input type="text" id="IDNumber" name="IDNumber" class="form-control" placeholder="ID *" value="" required/>
                                    </div>
                                    <label for="dob">DOB *</label>
                                    <div class="form-group">
                                        <input type="date" id="dob" name="DOB" class="form-control" placeholder="DOB *" value="" required/>
                                    </div>
                                    <label for="gender">Gender *</label>
                                    <div class="form-group">
                                        <select id="gender" name="Gender" class="form-control">
                                            <option selected disabled>Select Gender *</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email *</label>
                                    <div class="form-group">
                                        <input type="email" id="email" name="Email" class="form-control" placeholder="Email *" value="" />
                                    </div>
                                    <label for="phone">PhoneNo *</label>
                                    <div class="form-group">
                                        <input type="text" id="phone" name="PhoneNo" minlength="10" maxlength="10" class="form-control" placeholder="PhoneNo *" value="" />
                                    </div>
                                    <label for="image">Image</label>
                                    <div class="form-group">
                                        <input type="file" id="image" name="Image" class="form-control-file">
                                    </div>
                                    <label for="address">Address *</label>
                                    <div class="form-group">
                                        <input type="text" id="address" name="Address" class="form-control" placeholder="Address *" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Register</button>
                                </div>
                            </div>
                        </form>
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
