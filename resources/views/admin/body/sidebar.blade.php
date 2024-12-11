<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar sidebar-sticky">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-building"></i>
                    Properties
                </a>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addproperty') }}">Add Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.property') }}">View Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Properties</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                    Management
                </a>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addmanager') }}">Add Management Personnel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.managers') }}">View Management</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-friends"></i>
                    Tenants
                </a>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addtenant') }}">Add Tenant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Tenants</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-dollar-sign"></i>
                    Rent Payment
                </a>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Paid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Invoice</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-headset"></i>
                    Customer Care
                </a>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Complaints</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
