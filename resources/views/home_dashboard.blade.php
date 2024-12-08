<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RealEstate</title>

  <!-- Preload Images -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <style>
    /* Carousel Styling */
    .carousel-inner img {
      width: 100%;
      height: 100%;
      transition: opacity 2s ease-in-out; /* Smooth transition for images */
    }

    .carousel-item {
      opacity: 0;
      transition: opacity 2s ease-in-out; /* Smooth opacity transition */
    }

    .carousel-item.active {
      opacity: 1;
    }

    /* Background Image Change Styling */
    .content-header {
      background-size: cover;
      background-position: center;
      height: 400px; /* Adjust the height to your preference */
      transition: background-image 1s ease-in-out; /* Smooth transition for background images */
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.homenavbar')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('Content')
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script>
    // Initialize Bootstrap carousel
    $('.carousel').carousel({
      interval: 8000 // Image transition interval in milliseconds
    });

    document.addEventListener("DOMContentLoaded", function () {
      const header = document.querySelector('.content-header');
      const images = [
        '{{ asset('property_images/apart3.jpg') }}',
        '{{ asset('property_images/apart1.jpg') }}',
        '{{ asset('property_images/apart2.jpg') }}',
        '{{ asset('property_images/apart4.jpg') }}',
        '{{ asset('property_images/apart6.jpg') }}'
      ];
      let currentImage = 0;



      function changeBackgroundImage() {
        header.style.backgroundImage = `url('${images[currentImage]}')`;
        currentImage = (currentImage + 1) % images.length;
      }

      preloadImages(); // Preload images to reduce delay
      setInterval(changeBackgroundImage, 8000); // Change image every 8 seconds
    });
  </script>
</body>

</html>
