<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 56px; /* Adjust to match the navbar height */
            height: calc(100vh - 56px);
            padding-top: 1rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .nav-link.active {
            color: #007bff !important;
        }
        .nav-link:hover {
            color: #0056b3 !important;
        }
        .nav-item .fa {
            margin-right: 5px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .footer {
            background: #f8f9fa;
            text-align: center;
            padding: 10px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            margin-right: 20px;
        }
        .sidebar .card {
            margin-top: 20px; /* Adjust this value as needed */
        }

        /* Sidebar styling */
        .sidebar {
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease; /* Add smooth transition effect */
        }

        .sidebar:hover {
            width: 250px; /* Expand sidebar on hover */
        }

        .sidebar .nav-link {
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .nav .nav-link.active {
            background-color: rgba(0, 123, 255, 0.1);
            color: #007bff;
            border-right: 3px solid #007bff;
        }

        /* Dropdown styling */
        .sidebar .nav .nav-item ul.nav.flex-column {
            display: none;
            margin-left: 20px;
        }

        .sidebar .nav .nav-item:hover ul.nav.flex-column {
            display: block;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    @include('admin.body.navbar')
    <!-- /.navbar -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('admin.body.sidebar')
            <!-- /.sidebar -->

            <!-- Content Wrapper. Contains page content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @yield('admin')
            </main>
            <!-- /.content-wrapper -->
        </div>
    </div>

    <!-- Main Footer -->
    @include('admin.body.footer')

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <!-- Vite script -->
    @vite(['resources/js/app.js'])
</body>

</html>
