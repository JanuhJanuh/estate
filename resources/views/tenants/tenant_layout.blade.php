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

    .background-image {
      height: 300px;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border: 3px solid #ccc;
    }

    .info-title {
      color: #333;
      margin-bottom: 15px;
    }

    .tenant-details, .room-info, .apartment-info {
      margin-bottom: 20px;
    }

    .sidebar {
      background-color: #f8f9fa;
      padding: 20px;
      height: 100%;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .room-details-card {
      background-size: cover;
      background-position: center;
      border-radius: 8px;
      padding: 20px;
      color: #333;
    }

    .room-details-card .card-body {
      border-radius: 8px;
      padding: 20px;
    }

    .contact-section {
      display: none;
      background-color: #f8f9fa;
      padding: 50px 0;
      text-align: center;
    }

    .payment-actions .card {
      border: none;
      background-color: transparent;
    }

    .payment-actions .btn i {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  @include('tenants.body.header')
  <div class="container-fluid">
    <div class="row">
      @include('tenants.body.sidebar')

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <section class="hero">
          @if($apartment)
            <h1>Welcome to {{ $apartment->PName }}</h1>
            <p>{{ $apartment->Address }}</p>
          @else
            <p>No Room/Apartment assigned.</p>
          @endif
        </section>

        <div class="tenant-details row">
          <div class="col-md-3">
            <img src="{{ asset('tenant_images/' . $tenant->IDImage) }}" alt="Tenant Image" class="img-fluid rounded-circle">
          </div>
          <div class="col-md-9">
            <h3>{{ $tenant->Name }}</h3>
            <p>Email: {{ $tenant->Email }}</p>
            <p>Phone: {{ $tenant->Phone }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="apartment-details">
              <h4>Apartment Details</h4>
              @if($apartment)
                <p>Name: {{ $apartment->PName }}</p>
                <p>Location: {{ $apartment->Address }}</p>
              @else
                <p>No apartment assigned.</p>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="room-details">
              <h4>Unit Details</h4>
              @if($room)
                <p>Unit Number: {{ $room->room_number }}</p>
                <p>Unit Type: {{ $room->room_type }}</p>
                <p>Entry Date: {{ $entry_date }}</p>
              @else
                <p>No room assigned.</p>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="history-payment">
              <h4>Payment Details</h4>
              <!-- Adjust this section as per your data -->
            </div>
          </div>
        </div>

        <div class="payment-actions text-center mt-4">
          <div class="card-deck">
            <div class="card no-bg">
              <div class="card-body">
                <h5 class="card-title">Deposit Payment</h5>
                <p class="card-text">Make a deposit payment for your unit.</p>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#depositModal"><i class="fas fa-dollar-sign"></i> Pay Deposit</a>
              </div>
            </div>
            <div class="card no-bg">
              <div class="card-body">
                <h5 class="card-title">Rent Payment</h5>
                <p class="card-text">Pay your monthly rent here.</p>
                <a href="#" class="btn btn-secondary"><i class="fas fa-money-bill-wave"></i> Pay Rent</a>
              </div>
            </div>
            <div class="card no-bg">
              <div class="card-body">
                <h5 class="card-title">Invoice</h5>
                <p class="card-text">View and download your invoices.</p>
                <a href="#" class="btn btn-secondary"><i class="fas fa-file-invoice"></i> View Invoice</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Deposit Payment Modal -->
        <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="depositModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Deposit Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="payment-form" method="POST" action="{{ route('mpesa.pay') }}">
                  @csrf
                  <p><strong>Tenant Name:</strong> {{ $tenant->Name }}</p>
                  <p><strong>Room Number:</strong> @if($room) {{ $room->room_number }} @else Not assigned @endif</p>

                  <p><strong>Amount:</strong> ${{ $room->charges }}</p>
                  <div class="form-group">
                    <label for="phone"><strong>Phone Number:</strong></label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $tenant->Phone }}">
                  </div>
                  <input type="hidden" name="amount" value="{{ $room->charges }}">
                  <input type="hidden" name="room_number" value="{{ $room->room_number }}">
                  <input type="hidden" name="tenant_name" value="{{ $tenant->Name }}">

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-dollar-sign"></i> Pay Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
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
