 <!-- /.row -->
 <div class="row">
    <div class="col-12">
        @include('petugas/ulasan/delete')
        @include('adminlte/flash')
      <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Judul</th>
                <th>Ulasan</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($ulasan as $item)
                <tr>
                    <td>{{ $loop-> iteration }}</td>
                    <td>{{ $item->anggota->name }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->ulasan }}</td>
                    <td>
                        <span wire:click="hapus({{ $item->id }})" class="btn btn-sm btn-danger mr-2">Hapus</span>
                    </td>
                </tr>
                    @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  @if($delete)
<div class="modal fade show" id="modal-default" role="dialog" style="padding-right: 17px; display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ulasan</h4>
        <span wire:click="format"  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <span wire:click="format" type="button" class="btn btn-default" data-dismiss="modal">Batal</span>
        <span wire:click="destroy({{ $ulasan_id }})"  type="button" class="btn btn-danger">Hapus</span>
      </div>
    </div>
  </div>
</div>
@endif
  <!-- /.row -->