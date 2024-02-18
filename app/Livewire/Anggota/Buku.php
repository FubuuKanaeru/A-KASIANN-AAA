<?php

namespace App\Livewire\Anggota;

use App\Models\Buku as ModelsBuku;
use App\Models\DetailPeminjaman;
use App\Models\DetailPeminjaman as DetailPeminjaman1;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['pilihKategori','semuaKategori'];

    public $kategori_id, $pilih_kategori ,$buku_id, $detail_Buku, $Search;

    public function pilihKategori($id)
    {
        $this->format();
        $this->kategori_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }
    public function semuaKategori()
    {
        $this->format();
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function detailBuku($id)
    {
        $this->format();    
        $this->detail_Buku = true;
        $this->buku_id = $id;

    }

    public function keranjang(ModelsBuku $buku)
    {
        // user harus login
        if (auth()->user()) {
            
            // role peminjam
            if (auth()->user()->hasRole('anggota')) {
               
                $peminjaman_lama = DB::table('peminjaman')
                    ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                    ->where('anggota_id', auth()->user()->id)
                    ->where('status', '!=', 3)
                    ->get();

                // jumlah maksimal 2
                if ($peminjaman_lama->count() == 2) {
                    session()->flash('gagal', 'Buku yang dipinjam maksimal 2');
                } else {

                    // peminjaman belum ada isinya
                    if ($peminjaman_lama->count() == 0) {
                        $peminjaman_baru = Peminjaman::create([
                            'kode_pinjam' => random_int(100000000, 999999999),
                            'anggota_id' => auth()->user()->id,
                            'status' => 0
                        ]);

                        DetailPeminjaman::create([
                            'peminjaman_id' => $peminjaman_baru->id,
                            'buku_id' => $buku->id
                        ]);
                        
                        $this->dispatch('tambahKeranjang');
                        session()->flash('Sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                    } else {

                        // buku tidak boleh sama
                        if ($peminjaman_lama[0]->buku_id == $buku->id) {
                            session()->flash('gagal', 'Buku tidak boleh sama');
                        } else {

                            DetailPeminjaman::create([
                                'peminjaman_id' => $peminjaman_lama[0]->peminjaman_id,
                                'buku_id' => $buku->id
                            ]);

                            $this->dispatch('tambahKeranjang');
                            session()->flash('Sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                        }

                    }

                }

            } else {
                session()->flash('gagal', 'Role user anda bukan peminjam');
            }

        } else {
            session()->flash('gagal', 'Anda harus login terlebih dahulu');
            redirect('/login');
        }
        
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function format(){
        $this->detail_Buku = false;
        $this->pilih_kategori = false;
        unset($buku_id);
        unset($kategori_id);
    }

    public function render()
    {

        if ($this->pilih_kategori) {

            if ($this->Search) {
                $buku = ModelsBuku::latest()->where('judul','like','%'.$this->Search.'%')->where('kategori_id', $this->kategori_id)->paginate(12);
            } else {
                $buku = ModelsBuku::latest()->where('kategori_id', $this->kategori_id)->paginate(12);
            }

            $title = Kategori::find($this->kategori_id)->name;

        } elseif ($this->detail_Buku){
            $buku = ModelsBuku::find($this->buku_id);
            $title = 'Detail buku';
        } else {
            if ($this->Search) {
                $buku = ModelsBuku::latest()->where('judul', 'like', '%' . $this->Search . '%')->paginate(12);
            } else {
                $buku = ModelsBuku::latest()->paginate(12);
            }
            $title = 'Semua Buku';
        }
        
        return view('livewire.anggota.buku',compact('buku','title'));
    }
}