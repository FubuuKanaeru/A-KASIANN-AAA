<div class="row">
        <div class="col-12">
          
    @include('admin/user/create')
    @include('admin/user/edit')
    @include('admin/user/delete')
    @include('adminlte/flash')

    <div class="btn-group mb-3" >
        <button wire:click="format" class="btn btn-sm bg-primary mr-2">Semua</button>
        <button wire:click="Admin" class="btn btn-sm bg-indigo mr-2">Admin</button>
        <button wire:click="Petugas" class="btn btn-sm bg-info mr-2">Petugas</button>
        <button wire:click="Anggota" class="btn btn-sm bg-success mr-2">Anggota</button>
      </div>
              <div class="card">
                <div class="card-header">
                    @if ($admin || $petugas || $anggota )
                    <span wire:click="Create" class="btn btn-sm btn-primary">Tambah</span>
                    @endif
                  
                     
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                        <input wire:model.live.throttle.500ms="search"  type="search" name="table_search" class="form-control float-right" placeholder="Search">
        
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    @if ($user->isNotEmpty())
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            @if ( $petugas || $anggota )
                            <th>Aksi</th>
                            @endif
                          
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if ($item->roles[0]->name == 'admin')
                                        <span class="badge bg-indigo">Admin</span>
                                    @elseif ($item->roles[0]->name == 'petugas')
                                        <span class="badge bg-olive">Petugas</span>
                                    @else
                                        <span class="badge bg-fuchsia">Peminjam</span>
                                    @endif
                                </td>
                                <td>
                                    @if ( $petugas || $anggota )
                                    <div class="btn-group">
                                        <span wire:click="Edit" class="btn btn-sm btn-warning mr-2">Edit</span>
                                        <span wire:click="Delete" class="btn btn-sm btn-danger">hapus</span>
                                       </div>
                                    @endif 
                               </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                @endif
                
            </div>
            <div class="row justify-content-center">
                {{$user->links()}}
            </div>
        
            @if ($user->isEmpty())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            Anda tidak memiliki data
                        </div>
                    </div>
                </div>
            @endif
              </div>
        </div>    

    