<?php

namespace App\Livewire\Anggota;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Keranjang extends Component
{

    public $tanggal_pinjam;    

    
    protected $rules = [
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
    ];

    public function Hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_Peminjaman)
    {
        // dd($peminjaman->detail_peminjaman);

        if ($peminjaman->detail_peminjaman->count() == 1 ) {
            $detail_Peminjaman->delete();
            $peminjaman->delete();
            session()->flash('Sukses', 'Berhasil di hapus');
            redirect('/');
        } else {
            // dd($detail_Peminjaman);
            $detail_Peminjaman->delete();
            session()->flash('Sukses', 'Berhasil di hapus');
            dispatch('hapuskeranjang');
        }
    }

    public function hapusSemua()
    {
        $keranjang = Peminjaman::latest()->where('anggota_id',auth()->user()->id)->where('status','!=',3)->first();
        foreach ($keranjang->detail_peminjaman as $detail_Peminjaman ) {
            $detail_Peminjaman->delete();
        }
        $keranjang->delete();
        session()->flash('Sukses', 'Berhasil di hapus');
        redirect('/');
    }

    public function pinjam(Peminjaman $keranjang)
    {
    $this->validate();
    $keranjang->update([
        'status' => 1,
        'tanggal_pinjam' => $this->tanggal_pinjam,
        'tanggal_kembali' => Carbon::create($this->tanggal_pinjam)->addDays(10)
    ]);
    session()->flash('Sukses', 'Buku Berhasil dipinjam ');
    
    }

    public function render()
    {
        $keranjang = Peminjaman::latest()->where('anggota_id',auth()->user()->id)->where('status','!=',3)->first();
        if (!$keranjang){
             return view('/home');
            // redirect('/');
            // return redirect('/');
        }
        return view('livewire.anggota.keranjang', [
            'keranjang' => $keranjang
        ]);
    }
}
