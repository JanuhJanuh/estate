@extends('home_dashboard')

@section('Content')
<!-- Main content -->
<header class="content-header" style="height: 400px; background-size: cover; background-position: center;">
  <div class="container-fluid">
    <div class="row align-items-center" style="height: 100%;">
      <div class="col-lg-6">
        <div class="header-content text-center text-lg-left">
          <h1 class="text-white">Welcome to Your Dream Home</h1>
          <p class="lead text-white">Discover a world of luxury living and exceptional homes</p>
          <a href="#featured-listings" class="btn btn-primary btn-lg mt-3">Explore Our Listings</a>
        </div>
      </div>
    </div>
  </div>
</header>





    <!-- div with vision -->
    <div class="row mt-4">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">
            <h5 class="card-title">Our Vision</h5>
          </div>
          <div class="card-body">
            <p class="card-text">
              At RealEstateX, our goal is to provide exceptional living experiences. From modern amenities to breathtaking views, we aim to create homes that inspire and elevate your lifestyle.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5>Why Choose Us?</h5>
          </div>
          <div class="card-body">
            <ul>
              <li><strong>Quality Living:</strong> Our apartments are designed for comfort and style.</li>
              <li><strong>Prime Locations:</strong> Discover homes in the heart of the city.</li>
              <li><strong>Modern Amenities:</strong> Enjoy state-of-the-art facilities and services.</li>
              <li><strong>Community Atmosphere:</strong> Become part of a vibrant and welcoming community.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel and Apartment Displays -->
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center" style="background: url('{{ asset('storage/apartment_images/bedsitter3.jpg') }}') no-repeat center center; background-size: cover; color: white;">
            <h5 class="card-title">Featured Apartments</h5>
            <div class="card-tools">
              <!-- Welcoming Comment and View More Button -->
              <div class="alert alert-info" style="background: rgba(255, 255, 255, 0.8);" role="alert">
                Welcome to our real estate platform! Explore our featured apartments and find your perfect home.
                <a href="#" class="btn btn-primary btn-sm ml-2">View More</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="apartmentCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="{{ asset('storage/apartment_images/home3.jpg') }}" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="col-md-8">
                      <h3>Luxury Apartment</h3>
                      <p>This luxury apartment offers spacious living areas, modern amenities, and a beautiful view of the city skyline. Perfect for families and professionals.</p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="{{ asset('storage/apartment_images/onebedroom1.jpg') }}" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="col-md-8">
                      <h3>Cozy Studio</h3>
                      <p>A cozy studio apartment located in the heart of the city. Ideal for singles and young professionals looking for convenience and comfort.</p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="{{ asset('storage/apartment_images/selfcontained3.jpg') }}" class="d-block w-100" alt="Slide 3">
                    </div>
                    <div class="col-md-8">
                      <h3>Spacious Loft</h3>
                      <p>This spacious loft features high ceilings, open floor plans, and modern finishes. A great choice for those who love urban living with style.</p>
                    </div>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#apartmentCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#apartmentCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar with New Apartments -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5>Latest Hot Apartments</h5>
          </div>
          <div class="card-body">
            <div class="media mb-3">
              <img src="{{ asset('storage/apartment_images/home3.jpg') }}" class="mr-3" alt="Hot Apartment 1" style="width: 64px; height: 64px; object-fit: cover;">
              <div class="media-body">
                <h6 class="mt-0">Modern Apartment</h6>
                <p>Spacious and modern apartment located in a prime area. Don't miss out!</p>
                <p class="text-muted">"Best place I've ever lived!" - John Doe</p>
              </div>
            </div>
            <div class="media mb-3">
              <img src="{{ asset('storage/apartment_images/home5.jpg') }}" class="mr-3" alt="Hot Apartment 2" style="width: 64px; height: 64px; object-fit: cover;">
              <div class="media-body">
                <h6 class="mt-0">Luxury Condo</h6>
                <p>Experience luxury living in this beautiful condo with amazing amenities.</p>
                <p class="text-muted">"A truly luxurious experience." - Jane Smith</p>
              </div>
            </div>
            <div class="media mb-3">
              <img src="{{ asset('storage/apartment_images/home6.jpg') }}" class="mr-3" alt="Hot Apartment 3" style="width: 64px; height: 64px; object-fit: cover;">
              <div class="media-body">
                <h6 class="mt-0">Cozy Studio</h6>
                <p>This cozy studio is perfect for singles or young professionals.</p>
                <p class="text-muted">"Absolutely love this place!" - Sarah Brown</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Additional Apartments Section -->
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card">
          <img src="{{ asset('storage/apartment_images/home6.jpg') }}" class="card-img-top" alt="Apartment 1">
          <div class="card-body">
            <h5 class="card-title">Modern Apartment</h5>
            <p class="card-text">A modern apartment with all the latest amenities. Located in a prime location, offering convenience and style.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="{{ asset('storage/apartment_images/home5.jpg') }}" class="card-img-top" alt="Apartment 2">
          <div class="card-body">
            <h5 class="card-title">Family Apartment</h5>
            <p class="card-text">A spacious family apartment with multiple bedrooms and bathrooms. Perfect for families looking for a comfortable home.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="{{ asset('storage/apartment_images/home4.jpg') }}" class="card-img-top" alt="Apartment 3">
          <div class="card-body">
            <h5 class="card-title">Elegant Penthouse</h5>
            <p class="card-text">An elegant penthouse with stunning views and luxurious amenities. Experience the height of luxury living.</p>
          </div>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection
