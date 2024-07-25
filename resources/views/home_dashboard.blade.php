<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RealEstate</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <style>
    .navbar-nav2 {
      margin-left: auto;
    }
    .carousel-inner img {
      width: 100%;
      height: 100%;
    }
    footer {
      background: #343a40;
      color: #fff;
      padding: 30px 0;
    }
    footer a {
      color: #ffffff;
    }
    footer a:hover {
      color: #ffd700;
      text-decoration: none;
    }
    footer .form-control {
      background: #495057;
      border: none;
      color: #ffffff;
    }
    footer .btn-primary {
      background: #007bff;
      border: none;
    }
    footer .btn-primary:hover {
      background: #0056b3;
    }
    .content-header {
      position: relative;
      overflow: hidden;
      background-size: cover;
      background-position: center;
      padding: 120px 0;
      text-align: center;
      color: white;
    }
    .content-header h1 {
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      margin-bottom: 20px;
    }
    .content-header p {
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }
    .btn-primary.btn-lg {
      margin-top: 20px;
    }
    .carousel-item {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }
    .carousel-item.active {
      opacity: 1;
    }
  </style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
   <div class="wrapper">

  <!-- Navbar -->
  @include('layouts.homenavbar')
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('Content')
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- Carousel Script -->
<script>
  $('.carousel').carousel({
    interval: 3000
  });

  document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector('.content-header');
    const images = [
      '{{ asset('storage/apartment_images/selfcontained3.jpg') }}',
      '{{ asset('storage/apartment_images/hotel1.jpg') }}',
      '{{ asset('storage/apartment_images/home6.jpg') }}'
    ];
    let currentImage = 0;

    function changeBackgroundImage() {
      header.style.backgroundImage = `url('${images[currentImage]}')`;
      currentImage = (currentImage + 1) % images.length;
    }

    setInterval(changeBackgroundImage, 8000); // Change image every 8 seconds
  });
</script>

<!-- Modal Script -->
<script>
$(document).ready(function () {
    $('#allocateRoomModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var tenantId = button.data('tenant-id');
        $('#tenantId').val(tenantId);

        // AJAX request to fetch available rooms
        $.ajax({
            url: '/manager/rooms/' + tenantId, // Adjust with your backend route
            type: 'GET',
            success: function (response) {
                $('#roomSelect').empty();
                response.rooms.forEach(function (room) {
                    $('#roomSelect').append($('<option>', {
                        value: room.id,
                        text: room.room_number + ' - ' + room.type + ' - ' + room.charges
                    }));
                });
            },
            error: function () {
                alert('Error fetching available rooms.');
            }
        });
    });

    $('#allocateRoomForm').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/manager/roomcheck_in', // Backend route
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#allocateRoomModal').modal('hide');
                window.location.href = '/manager/view_tenants'; // Redirect to tenants list page
                alert('Room allocated successfully.');
            },
            error: function () {
                alert('Error allocating room.');
            }
        });
    });
});
</script>
</body>
</html>
