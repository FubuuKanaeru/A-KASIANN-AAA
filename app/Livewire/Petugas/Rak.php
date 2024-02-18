<?php

namespace App\Livewire\Petugas;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\Rak as ModelsRak;
use Livewire\WithPagination;

class Rak extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $create, $edit, $delete;
    public $rak, $baris, $kategori, $kategori_id, $rak_id, $search,$nama;

    protected $messages = [
        'rak.required' => 'Rak harus diisi',
        'baris.required' => 'Baris harus diisi',
        'kategori_id.required' => 'Silahkan pilih kategori',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori'
    ];


    // public function halo() {
    //     $kategori = Kategori::with('kategori_id')->get();
    //     $rak = Rak::all();
        
    // }
    public function Create()
    {
        $this->create = true;
        $this->kategori = Kategori::all();
    }
    public function store()
    {
        $rak_pilihan = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');
       
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_pilihan,
            'kategori_id' => 'required|numeric|min:1',
        ]);
        
        ModelsRak::create([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak .'-' .$this->baris
        ]);

        session()->flash('Sukses', 'Data berhasil ditambahkan.');

        $this->format();
    }
    public function Edit(ModelsRak $rak) {
        
        $this->format();

        $this->edit = true;
        $this->rak_id = $rak->id;
        $this->rak = $rak->rak;
        $this->baris = $rak->baris;
        $this->kategori_id = $rak->kategori_id;
        $this->kategori = Kategori::all();

    }

    public function update(ModelsRak $rak){
         
        $rak_lama = ModelsRak::find($this->rak_id);
        
        if ($rak_lama->rak == $this->rak){
        $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->where('baris' ,'!=',$rak_lama->baris)->get()->implode('baris', ',');
        } else {
        $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');
        }
        
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_baru,
            'kategori_id' => 'required|numeric|min:1',
        ]);

        $rak->update([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak .'-'.$this->baris
        ]);

        session()->flash('Sukses', 'Data berhasil Diubah.');

        $this->format();    
    }

    public function Delete(ModelsRak $rak){
        $this->delete = true;
        $this->rak_id = $rak->id;

        
    }
    public function destroy(ModelsRak $rak){

        $buku = Buku::where('rak_id',$rak->id)->get();
        foreach ($buku as $key => $value) {
            $value->update([
                'rak_id' => 1
            ]);

        }
    
    $rak->delete();

    session()->flash('Sukses', 'Data berhasil Diubah.');

    $this->format();   
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $raks = ModelsRak::latest()->where('rak',$this->search)->paginate(5);
        } else {
            $raks = ModelsRak::latest()->paginate(5);
        }
        $count =  ModelsRak::select('rak')->distinct()->get();
        
        return view('livewire.Petugas.Rak', compact('raks','count'));
        
      $this->format();    
    }


    public function format() {

        unset($this->nama);
        unset($this->create);
        unset($this->rak_id);
        unset($this->edit);
        unset($this->rak);
        unset($this->baris);
        unset($this->kategori_id);
        unset($this->kategori);
        unset($this->delete);
    
        }

        public function formatSearch()
        {
            $this->search = false;
        }
}
