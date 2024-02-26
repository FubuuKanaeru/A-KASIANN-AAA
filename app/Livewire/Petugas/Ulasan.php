<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Ulasan as ModelsUlasan;

class Ulasan extends Component
{
    public $delete, $ulasan_id;

    public function hapus(ModelsUlasan $ulasan){
      
        $this->format();
        $this->delete = true;
        $this->ulasan_id = $ulasan->id;

    }

    public function destory(ModelsUlasan $ulasan){
        
        $ulasan->delete();
        session()->flash('Sukses', 'Data berhasil dihapus.');
        $this->format();

    }

    public function render()
    {
        return view('livewire.petugas.ulasan',[
            'ulasan' => ModelsUlasan::latest()->paginate(5)
        ]);
    }

    public function format(){

        unset($this->delete);
        unset($this->ulasan_id);
        unset($this->ulasan);

    }
}
