<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">RealEstate Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="propertyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Properties
                </a>
                <ul class="dropdown-menu" aria-labelledby="propertyDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.addproperty') }}">Add Property</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.property') }}">View Properties</a></li>
                    <li><a class="dropdown-item" href="#">Manage Properties</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="managerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Management
                </a>
                <ul class="dropdown-menu" aria-labelledby="managerDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.addmanager') }}">Add Management Personnel</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.managers') }}">View Management</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="tenantDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Tenants
                </a>
                <ul class="dropdown-menu" aria-labelledby="tenantDropdown">
                    <li><a class="dropdown-item" href="#">Add Tenant</a></li>
                    <li><a class="dropdown-item" href="#">View Tenants</a></li>
                    <li><a class="dropdown-item" href="#">Manage Tenants</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="rentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Rent Payment
                </a>
                <ul class="dropdown-menu" aria-labelledby="rentDropdown">
                    <li><a class="dropdown-item" href="#">Paid</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Invoice</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="customerCareDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Customer Care
                </a>
                <ul class="dropdown-menu" aria-labelledby="customerCareDropdown">
                    <li><a class="dropdown-item" href="#">Email</a></li>
                    <li><a class="dropdown-item" href="#">Contact Us</a></li>
                    <li><a class="dropdown-item" href="#">Complaints</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown hover-dropdown">
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> {{ Auth()->user()->UserName }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a href="#" class="dropdown-item">Profile</a></li>
                        <li><a href="#" class="dropdown-item">Change Password</a></li>
                        <li>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    // Add hover functionality to dropdowns
    document.querySelectorAll('.hover-dropdown').forEach(function(el) {
        el.addEventListener('mouseover', function() {
            this.querySelector('.dropdown-menu').classList.add('show');
        });
        el.addEventListener('mouseleave', function() {
            this.querySelector('.dropdown-menu').classList.remove('show');
        });
    });
</script>
