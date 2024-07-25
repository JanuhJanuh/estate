<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <!-- Manager Information Container -->
            <li class="nav-item mb-3">
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <i class="fas fa-user fa-3x mb-2"></i>
                        <h5 class="card-title">{{ Auth::user()->Name }}</h5>
                        @php
                            $manager = Auth::user();
                            $manageMgr = $manager->allocation;
                            $property = optional($manageMgr)->property;
                        @endphp
                        @if ($property)
                            <div>
                                <p class="card-text mb-2">{{ $property->PName }}</p>
                                                        <img src="{{ asset('storage/' . $property->logo) }}" alt="Apartment Logo" class="img-fluid" style="width: 50px; height: 50px;">
                            </div>
                        @else
                            <p class="card-text mb-2">Manager Not Allocated</p>
                        @endif
                    </div>
                </div>
            </li>


            <!-- Tenant Management Dropdown -->
            <li class="nav-item dropdown">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tenant Management</h6>
                        <ul class="nav flex-column dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.addtenant') }}">Add Tenant</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.view_tenants') }}">View Tenants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Manage Payments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- Room Management Dropdown -->
            <li class="nav-item dropdown">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Unit Management</h6>
                        <ul class="nav flex-column dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#">View Units</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Allocate Tenant</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- Finance Management Dropdown -->
            <li class="nav-item dropdown">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Finance Management</h6>
                        <ul class="nav flex-column dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Rent Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">View Payments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

              <!-- Manage Apartment   -->
              <li class="nav-item dropdown">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Apartment Management</h6>
                        <ul class="nav flex-column dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.manageapartmentform') }}">Manage Rooms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.apartmentunits') }}">View Units</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.showapartmentunits') }}">Show Units2</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- Other Fields Container -->
            <li class="nav-item">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-info-circle"></i>
                                    More Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-cog"></i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
    .nav-item .dropdown-menu {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 1000;
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
    }

    .nav-item.dropdown:hover .nav-link.active {
        background-color: #f8f9fa; /* Change active link background color */
    }
</style>
