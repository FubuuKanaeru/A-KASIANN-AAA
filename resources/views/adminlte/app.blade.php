<!DOCTYPE html>
<html lang="en">
<head>
  @include('adminlte/header')
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <!-- Preloader -->
 @include('adminlte/prealoder')

  <!-- Navbar -->
  @include('adminlte/navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('adminlte/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('adminlte/main-header')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @yield('content')
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('adminlte/footer')
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('adminlte/javascript')
@include('adminlte/script')
@livewireScripts
</body>
</html>