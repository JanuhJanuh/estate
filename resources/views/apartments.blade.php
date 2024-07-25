@extends('home_dashboard')

@section('Content')
<!-- Apartments Section -->
<section class="content">
  <!-- Main content -->
  <header class="content-header" style="height: 400px; background-size: cover; background-position: center;">
    <div class="container-fluid">
      <div class="row align-items-center" style="height: 100%;">
        <div class="col-lg-6">
          <div class="header-content text-center text-lg-left">
            <h1 class="text-white">Welcome to Kyeni Apartments</h1>
            <p class="lead text-white">Discover a world of luxury living and exceptional homes</p>
            <a href="#featured-listings" class="btn btn-primary btn-lg mt-3">Explore Our Units</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <h1 class="text-center mb-5">Available Apartments</h1>
    <div class="row">
      @foreach($apartments as $apartment)
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm" style="height: 350px;">
            <div class="position-relative">
              <img src="{{ asset('property_images/'.$apartment->images->first()->image_path) }}" alt="Property Image" style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-img-overlay">
                <h5 class="card-title text-white">{{ $apartment->PName }}</h5>
                <p class="card-text text-white"><strong>Address:</strong> {{ $apartment->Address }}</p>
                <a href="#" class="btn btn-primary stretched-link">View More</a>
              </div>
            </div>
            <div class="card-body">
              <p class="card-text">{{ \Illuminate\Support\Str::limit($apartment->Description, 90, '...') }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- End Apartments Section -->
@endsection
