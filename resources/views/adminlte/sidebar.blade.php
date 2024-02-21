

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #0035e4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/AdminLTE-3.2.0/Logo/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar --> 
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>


    <!-- Sidebar Menu -->
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="/dashboard" class="nav-link @yield('active-dashboard' )">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Master</li>
<li class="nav-item">
  <a href="#" class="nav-link @yield('active-data-master')">
    <i class="nav-icon fas fa-copy"></i>
    <p>
      Data Master
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/kategori" class="nav-link @yield('active-kategori')">
        <i class="far fa-circle nav-icon"></i>
        <p>Kategori</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/rak" class="nav-link @yield('active-rak')">
        <i class="far fa-circle nav-icon"></i>
        <p>Rak</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/penerbit" class="nav-link @yield('active-penerbit')">
        <i class="far fa-circle nav-icon"></i>
        <p>Penerbit</p>
      </a>
    </li>
  </ul>
</li>

{{-- Stark Book --}}
<li class="nav-item">
  <a href="/buku" class="nav-link @yield('active-buku')">
    <i class="fas fa-book"></i>
    <p>Buku</p>
  </a>
</li>

       
{{-- Start View Transaksi --}}
        <li class="nav-item">
          <a href="/transaksi"class="nav-link"> @yield('active-transaksi ')
            <i class="fas fa-book"></i>
            <p>
              Transaksi
            </p>
          </a>
      </li>

        <li class="nav-item">
          <a href="/pdf/buku/laporan"class="nav-link"> @yield('active-transaksi ')
            <i class="fas fa-book"></i>
            <p>
          Laporan buku
            </p>
          </a>
      </li>
        <li class="nav-item">
          <a href="/pdf/transaksi/laporan"class="nav-link"> @yield('active-transaksi ')
            <i class="fas fa-book"></i>
            <p>
         Laporan Transaksi
            </p>
          </a>
      </li>


{{-- end Transaksi --}}

@role('admin')
<li class="nav-header">Admin</li>
<li class="nav-item">
<a href="/user"class="nav-link"> @yield('active-user ')
  <i class="fas fa-users"></i>
  <p>
    Data User
  </p>
</a>
</li>

@endrole
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>