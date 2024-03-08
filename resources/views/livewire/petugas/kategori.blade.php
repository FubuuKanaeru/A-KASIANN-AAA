<div class="row">
    <div class="col-12">
      
@include('petugas/kategori/create')
@include('petugas/kategori/edit')
@include('petugas/kategori/delete')
@include('adminlte/flash')

          <div class="card">
            <div class="card-header">
                <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</span>
                 
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
      @if ($kategori->isNotEmpty())
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
                <tr>
                  <th width="10%">No</th>
                  <th>kategori</th>
                  @role('admin')
                  <th widht="15%">Aksi</th>
                  @endrole
                </tr>
          </thead>
          <tbody>
            @foreach ($kategori as $item)
            @if ($item->id != 1)
            <tr>
                  <td>{{ $loop -> iteration }}</td>
                  <td>{{ $item -> name }}</td>
                  @role('admin')
                  <td>
                    <div class="btn-group">
                    <span wire:click="Edit({{ $item->id }})" class="btn btn-sm btn-warning mr-2"><i class="fas fa-pen"></i>Edit</span>
                    <span wire:click="Delete({{ $item->id }})" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Hapus</span>
                   </div>
               </td>
                  @endrole
                 
            </tr>
            @endif  
            @endforeach
          </tbody>
        </table>
                
        </div>
        @endif
        <!-- /.card-body -->
      <!-- /.card -->

      <div class="row justify-content-center">
        {{ $kategori->links() }}
      </div>
      
      @if($kategori->isEmpty())
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
</div>




  