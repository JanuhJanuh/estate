<nav class="navbar navbar-expand-md navbar-light" style="background-color: #ccffe6;">
    <a class="navbar-brand" href="{{ route('manager.dashboard') }}">Real Estate Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('manager.dashboard') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Apartments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Managers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tenants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>

            <!-- Logout Form -->
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none; background: none;">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
