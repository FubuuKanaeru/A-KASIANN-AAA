@extends('adminlte/app')

@section('content')
    <div class="card">
    <div class="card-header">
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Anggota</th>
        <th>Sampul</th>
        <th>Judul Buku</th>
        <th>Ulasan Buku</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
      <tr>
        <td>{{ $loop -> iteration }}</td>
          <td>{{ $item->anggota->name }}</td> 
          <td><img src="/storage/{{$item->buku->sampul}}" alt="{{$item->buku->judul}}" width="60" height="80"></td>
          <td>{{ $item->buku->judul }}</td> 
          <td>{{ $item->ulasan }}</td>
           <td>
        </td>
        <td>

          <a data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-danger"><i class="fas fa-pen">Hapus</i></a>
        {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="/dashboard/ulasan/destroy/{{ $item->id }}" method="GET">
          @csrf
          @method('DELETE');
          {{-- @method('DELETE') --}}
          <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
      </form> --}}
        </td>
      </tr>
      {{-- modal --}}
      <div class="modal fade" id="modal-hapus{{ $item->id }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi hapus data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Hapus data? <b>{{ $item->ulasan }}</b></p>
            </div>
            <div class="modal-footer justify-content-between">
           <form action="/dashboard/delete/{{ $item->id }}'" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Hapus Sekarang!!</button>
           </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
@endsection