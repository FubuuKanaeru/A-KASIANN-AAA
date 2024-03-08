<?php

namespace App\Livewire\Petugas;

use App\Models\Kategori as ModelsKategori;
use App\Models\Rak;
use App\Models\Buku;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Kategori extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $Create, $nama, $kategori_id, $edit, $delete, $buku, $search;

    protected $rules = [
        'nama' => 'required|min:5',
    ];
    
    // Tambah Table

    public function create()
{
    $this->format();
    $this->Create = true;
}

public function store(){

    $this->validate();
  
    ModelsKategori::create([
        'name' => $this->nama,
        'slug' => Str::slug($this->nama)
    ]);
    
     session()->flash('Sukses', 'Data berhasil ditambahkan');

     $this->format();
}

//    Update table
  
public function update(ModelsKategori $kategori ){
    
    $this->validate();

    $kategori->update([

        'name' => $this->nama,
        'slug' => Str::slug($this->nama)

    ]);
    session()->flash('Sukses', 'Data berhasil perbarui');

    $this->format();

}
    public function Edit(ModelsKategori $kategori){
      
        $this->format();
        $this->edit = true;
        $this->nama = $kategori->name;
        $this->kategori_id = $kategori->id;

    }

    // Hapus Table

    public function Delete($id){

        $this->format();

        $this->delete=true;
        $this->kategori_id = $id;   
        // $this->dispatchBrowserEvent('delete');

}

public function destroy(ModelsKategori $kategori){
    // dd($kategori);
    // $kategori->rak()->delete();
    $rak = Rak::where('kategori_id', $kategori->id)->get();
    foreach ($rak as $key => $value) {
        $value->update([
            'kategori_id' => 1
        ]);
    }
    $buku = Buku::where('kategori_id', $kategori->id)->get();
    foreach ($buku as $key => $value) {
        $value->update([
            'kategori_id' => 1
        ]);
    }
    
   $kategori->delete();
    
   session()->flash('Sukses', 'Data berhasil dihapus');

   $this->format();

}
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        if ($this->search) {
            $kategori = ModelsKategori::latest()->where('name','LIKE','%'. $this->search .'%')->paginate(5);
        } else {
            $kategori =  ModelsKategori::latest()->paginate(5);
        }
        
        return view('livewire.petugas.kategori',[
            'kategori' =>  $kategori
        ]);
    }

    public function format() {

    unset($this->nama);
    unset($this->Create);
    unset($this->edit);
    unset($this->kategori_id);
    unset($this->delete);

    }
}
