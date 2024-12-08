@extends('home_dashboard')

@section('Content')
<!-- Main content -->
<header class="content-header position-relative" style="height: 500px; overflow: hidden;">
  <!-- Carousel -->
  <div id="backgroundCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner h-100">
      @foreach (['apart1.jpg', 'apart2.jpg', 'apart3.jpg', 'apart4.jpg', 'apart5.jpg', 'apart6.jpg'] as $index => $image)
        <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
          <div class="carousel-background h-100 w-100"
               style="background-size: cover; background-position: center; background-image: url('{{ asset('property_images/' . $image) }}');">
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Content Overlay -->

</header>

<!-- Vision & Why Choose Us Section -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card animated fadeInUp">
        <div class="card-header text-center bg-primary text-white">
          <h5 class="card-title">Our Vision</h5>
        </div>
        <div class="card-body">
          <p class="card-text">
            At RealEstateX, we are committed to offering more than just homes; we deliver exceptional living experiences. Our properties are designed with style, comfort, and luxury in mind, making your home an extraordinary place.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card animated fadeInRight">
        <div class="card-header bg-primary text-white">
          <h5>Why Choose Us?</h5>
        </div>
        <div class="card-body">
          <ul>
            <li><strong>Quality Living:</strong> Our apartments offer unparalleled comfort and elegance.</li>
            <li><strong>Prime Locations:</strong> Live in the heart of the city, close to everything you need.</li>
            <li><strong>Modern Amenities:</strong> Enjoy top-of-the-line facilities and services.</li>
            <li><strong>Thriving Community:</strong> Join a welcoming and vibrant neighborhood.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Featured Apartments Section -->
<div class="container my-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card animated fadeInUp">
        <div class="card-header text-center text-white" style="background: url('{{ asset('property_images/apart3.jpg') }}') no-repeat center center; background-size: cover;">
          <h5 class="card-title">Featured Apartments</h5>
        </div>
        <div class="card-body">
          <div id="apartmentCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ([
                ['img' => 'apart3.jpg', 'title' => 'Luxury Apartment', 'desc' => 'Spacious living areas, modern amenities, and a beautiful view of the city skyline.'],
                ['img' => 'apart4.jpg', 'title' => 'Cozy Studio', 'desc' => 'Ideal for singles and young professionals looking for convenience and comfort.'],
                ['img' => 'apart5.jpg', 'title' => 'Spacious Loft', 'desc' => 'Features high ceilings, open floor plans, and modern finishes for urban living with style.']
              ] as $index => $item)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="{{ asset('property_images/' . $item['img']) }}" class="d-block w-100 rounded shadow-lg" alt="{{ $item['title'] }}">
                    </div>
                    <div class="col-md-8">
                      <h3>{{ $item['title'] }}</h3>
                      <p>{{ $item['desc'] }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
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
      <div class="card animated fadeInRight">
        <div class="card-header bg-primary text-white">
          <h5>Latest Hot Apartments</h5>
        </div>
        <div class="card-body">
          @foreach ([
            ['img' => 'apart6.jpg', 'title' => 'Modern Apartment', 'desc' => 'Spacious and modern, in a prime area.'],
            ['img' => 'apart2.jpg', 'title' => 'Luxury Condo', 'desc' => 'Beautiful condo with amazing amenities.'],
            ['img' => 'apart1.jpg', 'title' => 'Cozy Studio', 'desc' => 'Perfect for singles or young professionals.']
          ] as $item)
            <div class="media mb-3">
              <img src="{{ asset('property_images/' . $item['img']) }}" class="mr-3 rounded-circle" style="width: 64px; height: 64px; object-fit: cover;" alt="{{ $item['title'] }}">
              <div class="media-body">
                <h6 class="mt-0">{{ $item['title'] }}</h6>
                <p>{{ $item['desc'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Additional Apartments Section -->
<div class="container my-5">
  <div class="row">
    @foreach ([
      ['img' => 'apart6.jpg', 'title' => 'Modern Apartment', 'desc' => 'Modern with the latest amenities, in a prime location.'],
      ['img' => 'apart5.jpg', 'title' => 'Family Apartment', 'desc' => 'Spacious with multiple bedrooms, ideal for families.'],
      ['img' => 'apart4.jpg', 'title' => 'Elegant Penthouse', 'desc' => 'Luxurious penthouse with stunning views.']
    ] as $item)
      <div class="col-md-4 mb-4 animated fadeInUp">
        <div class="card h-100 shadow-sm border-light">
          <img src="{{ asset('property_images/' . $item['img']) }}" class="card-img-top" alt="{{ $item['title'] }}">
          <div class="card-body">
            <h5 class="card-title">{{ $item['title'] }}</h5>
            <p class="card-text">{{ $item['desc'] }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection
