<!-- resources/views/manager/manager_dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    </style>
</head>
<body>
    @include('manager.body.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('manager.body.sidebar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    @include('manager.body.footer')

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
