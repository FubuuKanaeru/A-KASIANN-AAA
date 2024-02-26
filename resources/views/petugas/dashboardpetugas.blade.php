@extends('adminlte/app')
@section('title','Dashboard')
@section('active-dashboard','active')
@section('content')


<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $transaksi }}</h3>
          <p>Jumlah Transaksi</p> 
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="/transaksi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $jumbuku }}</h3>
          <p>Jumlah Buku</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
        <a href="/buku" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $user }}</h3>
          <p>Jumlah User</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/user" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart" height="100"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>Buku Terbaru</h5>
           <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Judul</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($buku as $item)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->judul}}</td>
                  <td>{{$item->created_at->diffForHumans()}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>User Terbaru</h5>
           <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user1 as $item)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->created_at->diffForHumans()}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>Selesai Dipinjam</h5>
           <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Kode Pinjam</th>
                <th>Tanggal Pengembalian</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($selesai_dipinjam as $item)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->kode_pinjam}}</td>
                  <td>{{$item->tanggal_pengembalian}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>Sedang Dipinjam</h5>
           <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Kode Pinjam</th>
                <th>Tanggal Pinjam</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sedang_dipinjam as $item)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->kode_pinjam}}</td>
                  <td>{{$item->tanggal_pinjam}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('chart-script')
    <livewire:petugas.chart-script></livewire:petugas.chart-script>
@endsection