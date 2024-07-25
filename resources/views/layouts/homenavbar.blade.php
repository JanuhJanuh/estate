 <!-- Navbar -->
 <style>
        .navbar-brand {
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            margin-right: 20px;
        }

        .nav-item .fa {
            margin-right: 5px;
        }
    </style>
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kyeni Estates</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"
                aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shops</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Apartments
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('estate.apartments')}}">2/3 Bedrooms</a>
                            <a class="dropdown-item" href="{{ route('estate.apartments')}}">1 Bedrooms</a>
                            <a class="dropdown-item" href="#">Single Rooms</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Guest House</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            LOGIN
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="IDNumber">Enter ID Number</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="text" class="form-control" id="IDNumber" name="IDNumber"
                                    placeholder="ID/Passport Number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <div class="form-group">
                                <input type="submit" name="Login" value="Login" class="btn btn-block"
                                    style="color: green;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
