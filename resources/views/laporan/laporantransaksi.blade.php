@extends('adminlte/app')

@section('content')
                  <div class="card">
                    <div class="card-header">
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    {{-- <a href="{{ route('pdf.transaksi') }}">
                      <button class="btn btn-success"><i class="fa fa-file-pdf"></i> Generate PDF</button>
                    </a> --}}
                    <form action="/report" method="GET">
                      <label for="">Cari Berdasarkan Tanggal</label>
                      @csrf
                      <div class="row">
                        <div class="form-group m-4">
                          <label for="">Tanggal Awal</label>
                          <input name="tanggal_pinjam" type="date" class="form-control">
                        </div>
                      
                      <div class="col-md-2">
                        <div class="form-group m-4">
                          <label for="">Tanggal Akhir</label>
                          <input name="end_date" type="date" class="form-control">
                        </div>
                      </div>
                      <div class="form-group mt-5">
                        <div class="col-md-4 mt-2">
                          <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                      </div>
                    </div>
                    </form>
                    <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode pinjam</th>
        <th>Nama Peminjam</th>
        <th>Tanggal dipinjam</th>
        <th>Tanggal Kembali</th>
        <th>Judul</th>
        <th>Denda</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($peminjaman as $item)
      <tr>
        <td>{{ $loop -> iteration }}</td> 
        <td>{{ $item->kode_pinjam }}</td>
        <td>{{ $item->anggota->name }}</td>
        <td>{{ $item->tanggal_pinjam }}</td>
        <td>{{ $item->tanggal_kembali }}</td>
        <td>
          <ul>
              @foreach ($item->detail_peminjaman as $detail_peminjaman)
                <p>{{ $detail_peminjaman->buku->judul }}</p>
              @endforeach
          </ul>
          </td>
          <td>{{ $item->denda }}</td>
          <td>
            @if ($item->status == 3)
               <span>Selesai Dipinjam</span>
            @elseif($item->status == 2)
            <span>Sedang Dipinjam</span>
            @endif
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
@endsection