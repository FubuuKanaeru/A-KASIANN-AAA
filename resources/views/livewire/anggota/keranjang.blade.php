<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Keranjang</h1>
        </div>
    </div>

    @include('adminlte/flash')
    @include('anggota/buku/ulasan')

    <div class="row">
        <div class="col-md-12 mb-2">
            @if ($keranjang->status == 1)
            <span class="btn btn-sm btn-warning"> Menunggu Konfirmasi</span>
            @elseif($keranjang->status == 2)
            <strong>Tanggal Pinjam: {{$keranjang->tanggal_pinjam}}</strong>
            @else
                <button wire:click="pinjam({{$keranjang->id}})" class="btn btn-sm btn-success">Ajukan Peminjam</button>
            @endif
        </div>
        <div>
            <strong class="float-right">Kode Pinjam : {{$keranjang->kode_pinjam}}</strong>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-12">
             <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Rak</th>
                    <th>Baris</th>
                    <th>Status</th>
                    @if ($keranjang->status == 0)
                        <th>Aksi</th>   
                    @endif
                </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang->detail_peminjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->buku->judul}}</td>
                            <td>{{$item->buku->penulis}}</td>
                            <td>{{$item->buku->rak->rak}}</td>
                            <td>{{$item->buku->rak->baris}}</td>
                            <td>
                                @if ($keranjang->status == 1)
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @elseif($keranjang->status == 2)
                                <span class="badge bg-success">Peminjam Telah di setujui</span>
                                @elseif($keranjang->status == 3) 
                                <span class="badge bg-success"> buku selesai dipinjam</span>
                                @else
                                <span class="badge bg-success">belum dipinjam</span>
                                @endif
                            {{-- </td>
                                <a href="/ulasan/{{$item->buku->id}}" class="btn btn-primary">Ulas buku </a>
                            </td> --}}
                            <td>
                                @if ($keranjang->status == 0)
                                    <button wire:click="hapus({{$keranjang->id}}, {{$item->id}})" class="btn btn-sm btn-danger">Hapus</button>
                                @endif       
                                    @if($keranjang->status == 3)
                                    <button wire:click="hapus({{$keranjang->id}}, {{$item->id}})" class="btn btn-sm btn-danger">Hapus</button>
                                    <button wire:click="ulas({{ $item->buku->id }})" class="btn btn-sm btn-success">Ulas Buku</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (!$keranjang->tanggal_pinjam)
                 <button wire:click="hapusMasal" class="btn btn-sm btn-danger">Hapus Masal</button>
            @endif        
        </div>
    </div>
</div>