
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Transaksi</title>
  <style>
      thead
    {
      background-color:yellow;
    }
    table, th, td {
  border: 0.5px solid black;
  border-collapse: collapse;
}
  </style>
</head>
<body>


  <div class="row">
    <div class="col-md-12">
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <caption>Laporan Transaksi</caption>
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
        <td>l
              @foreach ($item->detail_peminjaman as $detail_peminjaman)
                <p>{{ $detail_peminjaman->buku->judul }}</p>
              @endforeach
          </td>
          <td>{{ $item->denda }}</td>
          <td>{{ $item->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </div>
</div>
</div>
</body>
</html>

