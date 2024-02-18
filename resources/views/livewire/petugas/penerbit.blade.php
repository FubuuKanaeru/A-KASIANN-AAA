<div class="row">
    <div class="col-12">
      
        @include('petugas/penerbit/create')
        @include('petugas/penerbit/edit')
        @include('petugas/penerbit/delete')
        @include('adminlte/flash') 
        
        <div class="card">
            <div class="card-header">
                <span wire:click="Create" class="btn btn-sm btn-primary">Tambah</span>
               
              @if ($penerbit->isNotEmpty())
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
          </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
              <tr>
                <th width="10%">No</th>
                <th>Penerbit</th>
                <th widht="15%">Aksi</th>
              </tr>
        </thead>
        <tbody>
          @foreach ($penerbit as $item)
          <tr>
                <td>{{ $loop -> iteration }}</td>
                <td>{{ $item -> nama }}</td>
                <td>
                    <div class="btn-group">
                    <span wire:click="Edit({{ $item->id }})" class="btn btn-sm btn-primary mr-2">Edit</span>
                    <span wire:click="Delete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</span>
                </div>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
              @endif

        </div>
        <!-- /.card-body -->
    </div>
      <!-- /.card -->

      <div class="row justify-content-center">
        {{ $penerbit->links() }}
      </div>

      @if ($penerbit->isEmpty())
      <div class="card">
        <div class="card-body">
          <div class="alert alert-warning">
            Anda tidak memiliki data
          </div>
        </div>
      </div>
      @endif
</div>
    
    