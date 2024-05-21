


<nav class="navbar  navbar-toggler navbar-expand-sm navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kyeni Estates</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Shops</a>
        </li>

            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Apartments
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">2/3 Bedrooms</a>
          <a class="dropdown-item" href="#">1 Bedrooms</a>
          <a class="dropdown-item" href="#">Singe Rooms</a>
        </div>
      </li>

            <li class="nav-item">
          <a class="nav-link" href="#">Guest House</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <ul class="navbar-nav2">
        <li class="nav-item">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  LOGIN
</button>

        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- LoginModal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="modal-body">
      <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="IDNumber">Enter ID Number</label>
        <div class="input-group pb-modalreglog-input-group">
            <input type="text" class="form-control" id="IDNumber" name="IDNumber" placeholder="ID/Passport Number" required>
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group pb-modalreglog-input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <div class="form-group">
            <input type="submit" name="Login" value="Login" class="btn btn-block" style="color: green;">
        </div>
    </div>
</form>

        </div>


      </div>

    </div>
  </div>
</div>
