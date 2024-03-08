<div class="row">
    <div class="col-12">
        @include('adminlte/flash')

      <div class="btn-group mb-3" >
        <button wire:click="format" class="btn btn-sm bg-primary mr-2">Semua</button>
        <button wire:click="belumDipinjam" class="btn btn-sm bg-danger mr-2">Belum dipinjam</button>
        <button wire:click="sedangDipinjam" class="btn btn-sm bg-info mr-2">Sedang dipinjam</button>
        <button wire:click="selesaiDipinjam" class="btn btn-sm bg-success mr-2">Selesai dipinjam</button>
      </div>

        <div class="card">
            <div class="card-header">
          
                <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input wire:model.live.throttle.500ms="search" type="search" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
          </div>
      <!-- /.card-header -->
      @if ($transaksi->isNotEmpty())
      <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
              <tr>
                <th width="10%">No</th>
                <th>Kode pinjam</th>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Lokasi</th>
                <th>Tanggal pinjam</th>
                <th>Tanggal kembali</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status</th>
                @if (!$selesai_dipinjam)
                  <th widht="15%">Aksi</th>
                @endif
              </tr>
        </thead>
        <tbody>
          @foreach ($transaksi as $item)
          <tr>
                <td>{{ $loop -> iteration }}</td>
                <td>{{ $item ->kode_pinjam }}</td>
                <td>{{ $item ->anggota->name }}</td>
                <td>
                <ul>
                    @foreach ($item->detail_peminjaman as $detail_peminjaman)
                        <li>{{ $detail_peminjaman->buku->judul }}</li>
                    @endforeach
                </ul>
                </td>
                <td>
                <ul>
                    @foreach ($item->detail_peminjaman as $detail_peminjaman)
                      <li>{{ $detail_peminjaman->buku->rak->lokasi }}</li>
                    @endforeach
                </ul>
                </td>
                <td>{{ $item ->tanggal_pinjam }}</td>
                <td>{{ $item ->tanggal_kembali }}</td>
                <td>{{ $item ->tanggal_pengembalian }}</td>
                <td>{{ $item ->denda }}</td>
                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-danger">Belum dipinjam</span>
                    @elseif($item->status == 2)
                    <span class="badge bg-info">Sedang dipinjam</span>
                    @else
                    <span class="badge bg-success">Selesai dipinjam</span>
                    @endif
                </td>
                @if (!$selesai_dipinjam)
                <td>
                  @if ($item->status == 1)
                  <span wire:click="pinjam({{ $item->id }})" class="btn btn-sm btn-success mr-2">Konfirmasi</span>
                  @elseif($item->status == 2)
                  <span wire:click="kembali({{ $item->id }})" class="btn btn-sm btn-primary mr-2">Kembalikan</span>
                  @endif
              </td>
            </tr>
                @endif
          @endforeach
        </tbody>
        </table>
        </div>
        @endif
        <!-- /.card-body -->
       
        </div>
      <!-- /.card -->

      <div class="row justify-content-center">
            {{ $transaksi->links() }}
      </div>

      @if ($transaksi->isEmpty())
          <div class="card">
            <div class="card-body">
              <div class="alert alert-warning">
                Data tidak tersedia
              </div>
            </div>
          </div>
      @endif

</div>

    
    