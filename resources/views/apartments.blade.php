@extends('home_dashboard')

@section('Content')
<!-- Apartments Section -->
<section class="content">
  <!-- Main content -->
  <header class="content-header" style="height: 400px; background: url('{{ asset('property_images/apart3.jpg') }}') no-repeat center center; background-size: cover;">
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

  <!-- Featured Apartments Section -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card animated fadeInUp shadow-lg rounded">
          <div class="card-header text-center text-white" style="background: url('{{ asset('property_images/apart3.jpg') }}') no-repeat center center; background-size: cover; border-radius: 10px 10px 0 0;">
            <h5 class="card-title">Featured Apartments</h5>
          </div>
          <div class="card-body">
          @foreach($apartments as $apartment)
    <div class="row mb-3 border rounded p-3 shadow-sm">
        <div class="col-md-4">
            @if($apartment->images->isNotEmpty())
            <img src="{{ asset('storage/' . $apartment->images->first()->image_path) }}" alt="Property Image" style="width: 100px; height: auto;">

            @else
                <img src="{{ asset('storage/apart1.jpg') }}" alt="Default Image" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-md-8">
            <h5 class="card-title">{{ $apartment->PName }}</h5>
            <p class="card-text"><strong>Address:</strong> {{ $apartment->Address }}</p>
            <p class="card-text"><strong>Rooms:</strong> {{ $apartment->Units }}</p>
            <p class="card-text">{{ \Illuminate\Support\Str::limit($apartment->Description, 90, '...') }}</p>
            <a href="#" class="btn btn-primary rounded-pill">View More</a>
        </div>
    </div>
@endforeach

          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- End Apartments Section -->
@endsection
