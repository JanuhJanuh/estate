
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="EstateLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Estates</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

    <li class="nav-item">
      <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-building"></i><label>Properties</label>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="{{route('admin.addproperty') }}" class="dropdown-item">Add Property</a>
                      <a href="{{route('admin.property') }}" class="dropdown-item">View Property</a>
                      <a href="#" class="dropdown-item">Manage Properties</a>


            </div>
         </div>

</li></p>
<li class="nav-item">
      <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-users"></i><label>Management</label>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="{{route('admin.addmanager') }}" class="dropdown-item">Add Management personel</a>
                      <a href="{{ route('admin.managers') }}" class="dropdown-item">View Management</a>

            </div>
         </div>

</li></p>
<li class="nav-item">
      <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-building"></i><label>Tenants</label>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Add tenant</a>
                      <a href="#" class="dropdown-item">View tenants</a>
                      <a href="#" class="dropdown-item">Manage Tenant</a>

            </div>
         </div>

</li></p>
<li class="nav-item">
      <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-money-bill-wave"></i><label> Rent Payment</label>
                    </button>
                    &nbsp;
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Paid</a>
                      <a href="#" class="dropdown-item">Pending</a>
                      <a href="#" class="dropdown-item">Invoice</a>

            </div>
         </div>

</li>
</p>

          <li class="nav-item">
          <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-hospital"></i><label>Customer Care</label>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Email</a>
                      <a href="#" class="dropdown-item">contact Us</a>
                      <a href="#" class="dropdown-item">Complains</a>

                     </div>
                    </p>
                 </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

