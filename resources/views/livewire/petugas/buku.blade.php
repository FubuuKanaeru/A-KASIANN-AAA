
<div class="row">
    <div class="col-12">
      
        @include('petugas/buku/create')
        @include('petugas/buku/edit')
        @include('petugas/buku/delete')
        @include('petugas/buku/show')
        @include('adminlte/flash')
      
        
        <div class="card">
            <div class="card-header">
                <span wire:click="Create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</span>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input wire:model.live.throttle.500ms="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
          </div>
    
    <!-- /.card-header -->
    @if ($buku->isNotEmpty())
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
              <tr>
                <th width="10%">No</th>
                <th>Sampul</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Waktu Ditambahkan</th>
                <th widht="15%">Aksi</th>
              </tr>
        </thead>
        <tbody>
          @foreach ($buku as $item)
          <tr>
                <td>{{ $loop -> iteration }}</td>
                <td><img src="/storage/{{$item->sampul}}" alt="{{$item->judul}}" width="60" height="80"></td>
                <td>{{ $item -> judul }}</td>
                <td>{{ $item -> penulis }}</td>
                <td>{{ $item -> kategori->name }}</td>
                <td>{{ $item -> stok }}</td>
                <td>{{$item->created_at->diffForHumans()}}</td>
                <td>
                <div class="btn-group">
                    <span wire:click="Show({{ $item->id }})" class="btn btn-sm btn-success mr-2"><i class="fas  fa-eye
                    "></i>Lihat</span>
                    @role('admin')
                    <span wire:click="Edit({{ $item->id }})" class="btn btn-sm btn-warning mr-2"><i class="fas fa-pen">Edit</i></span>
                    <span wire:click="Delete({{ $item->id }})" class="btn btn-sm btn-danger"><i class="fas fa-trash">Hapus</i></span>
                    @endrole
                </div>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
        </div>
        @endif
      </div>
      <!-- /.card -->

       <!-- /.card-body -->
       <div class="row justify-content-center">
        {{ $buku->links() }}
       </div>

      @if ($buku->isEmpty())
          <div class="card">
            <div class="card-body">
              <div class="alert alert-warning">
                Data tidak tersedia
              </div>
            </div>
          </div>
      @endif
</div>
</div>






    