<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tenant Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body {
      background-color: #ccffe6;
    }
    .hero {
      background-image: url('path-to-background-image.jpg');
      background-size: cover;
      padding: 50px;
      text-align: center;
      color: #4d79ff;
    }
    .tenant-details, .apartment-details, .history-payment {
      margin: 20px 0;
    }
    .tenant-details img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .sidebar-sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: 20px;
      overflow-x: hidden;
      overflow-y: auto;
    }
    .footer {
      background-color: #f8f9fa;
      padding: 20px;
      text-align: center;
      margin-top: 20px;
      border-top: 1px solid #e7e7e7;
    }
  </style>
</head>
<body>
  @include('tenants.body.header')
  <div class="container-fluid">
    <div class="row">
      @include('tenants.body.sidebar')
      @yield('content')
    </div>
  </div>
  <footer class="footer">
    <p>&copy; 2024 JayTech Solutions. All Rights Reserved.</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
