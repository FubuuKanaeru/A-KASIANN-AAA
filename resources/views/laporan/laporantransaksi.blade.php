@extends('adminlte/app')

@section('content')
                  <div class="card">
                    <div class="card-header">
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <a href="{{ route('pdf.transaksi') }}">
                      <button class="btn btn-success">Generate PDF</button>
                    </a>
                    <table class="table table-hover text-nowrap">
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
          <td>{{ $item->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
@endsection