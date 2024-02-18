<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;

class Kategori extends Component
{

    protected $listeners = ['tambahKeranjang','hapuskeranjang'];

    public $count;

    public function mount() 
    {
        if (auth()->user()) {
             $this->count = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
            ->where('anggota_id', auth()->user()->id)
            ->where('status', '!=', 3)
            ->count();
        } 
        
    }

    public function pilihKategori($id)
    {
        $this->dispatch('pilihKategori',$id);
    }

    public function semuaKategori()
    {
        $this->dispatch('semuaKategori');
    }

    public function tambahKeranjang(){

        $this->count += 1;

    }

    public function hapusKeranjang()
    {
        $this->count -= 1;
    }

    public function render()
    {
        return view('livewire.anggota.kategori',[
            'kategori' => ModelsKategori::where('id','!=',1)->get(),
            'count' => $this->count
        ]);
    }
}
