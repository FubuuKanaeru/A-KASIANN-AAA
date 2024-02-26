<?php

namespace App\Livewire\Anggota;

use App\Livewire\Petugas\Ulasan;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman; 
use App\Models\Ulasan as ModelsUlasan; 
use App\Models\Buku as ModelsBuku; 
use Carbon\Carbon;
use Livewire\Component;
use Psy\CodeCleaner\AssignThisVariablePass;

class Keranjang extends Component
{
    public $tanggal_pinjam,$ulasan,$buku_id,$create,$ulas_id;

    // protected $rules = [
    //     'tanggal_pinjam' => 'required|date|after_or_equal:today',
    // ];

    public function hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_peminjaman)
    {
        if ($peminjaman->detail_peminjaman->count() == 1) {
            $detail_peminjaman->delete();
            $peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            redirect('/');
        } else {
            $detail_peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            $this->dispatch('kurangiKeranjang');
        }  
    }

    public function hapusMasal()
    {
        $keranjang = Peminjaman::latest()->where('anggota_id', auth()->user()->id)->where('status', '!=', 3)->first();
        foreach ($keranjang->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->delete();
        }
        $keranjang->delete();
        session()->flash('sukses', 'Data berhasil dihapus');
        redirect('/');
    }

    public function pinjam(Peminjaman $keranjang)
    {
        // $this->validate();
        $this->tanggal_pinjam = $keranjang->tanggal_pinjam;
        $keranjang->update([
            'status' => 1,
            'tanggal_pinjam' => today(),
            'tanggal_kembali' => Carbon::create($this->tanggal_pinjam)->addDays(10)
        ]);

        session()->flash('sukses', 'Buku berhasil dipinjam');
     }
      
     public function ulas(ModelsBuku $buku,ModelsUlasan $ulas){

        $this->format();
        $this->create = true ;
        $this->buku_id = $buku->id;
        $this->ulas_id = $ulas->id;
     }

    public function store(ModelsBuku $buku,ModelsUlasan $ulas)
    {
        
        ModelsUlasan::create([
        'anggota_id' => auth()->user()->id,
        'buku_id' => $buku->id,
        'ulasan' => $this->ulasan
        ]);

        session()->flash('Sukses', 'Terim kasih atas ulasanya');
        $this->format();
    }


    public function render()
    {
        $keranjang = Peminjaman::latest()->where('anggota_id', auth()->user()->id)->first();
        // if (!$keranjang) {
        // return redirect('/');
        // // return view('/home');
        // }
        return view('livewire.anggota.keranjang', [
            'keranjang' => $keranjang
        ]);
    }

    public function format(){
        unset($this->ulasan);
        unset($this->buku_id);
        unset($this->create);
    }
}