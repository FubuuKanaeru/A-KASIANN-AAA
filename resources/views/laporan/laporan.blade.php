@extends('adminlte/app')

@section('content')
                  <div class="card">
                    <div class="card-header">
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <a href="{{ route('pdf.laporan') }}">
                      <button class="btn btn-success"><i class="fa fa-file-pdf"></i>Generate pdf</button>
                    </a>
                    <table class="table table-hover text-nowrap">
                  <thead>
                      <tr>
                        <th width="10%">No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Stok</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach ($buku as $item)
                  <tr>
                        <td>{{ $loop -> iteration }}</td>
                        <td>{{ $item -> judul }}</td>
                        <td>{{ $item -> penulis }}</td>
                        <td>{{ $item -> kategori->name }}</td>
                        <td>{{ $item ->penerbit->nama }}</td>
                        <td>{{ $item -> stok }}</td>
                        <td>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </div>

                  </div>
                  <!-- /.card -->

                  <!-- /.card-body -->

                  </div>
                  </div>

@endsection




  