<?php

namespace App\Livewire\Petugas;

use App\Models\Penerbit as ModelsPenerbit;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Buku;

class Penerbit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create, $nama, $edit,$penerbit_id, $delete;

    protected $rules = [
        'nama' => 'required',
    ];

    public function Create()
{
    $this->format();
    $this->create = true;
}

    public function store()
{
    $this->validate();

    ModelsPenerbit::create([
        'nama' => $this->nama,
        'slug' => Str::slug($this->nama),

    ]);

    session()->flash('Sukses', 'Data berhasil ditambahkan');

    $this->format();
}   

    public function Edit(ModelsPenerbit $penerbit){
    
        $this->format();

        $this->edit = true;
        $this->nama = $penerbit->nama;
        $this->penerbit_id = $penerbit->id;
    
    }

    public function update(ModelsPenerbit $penerbit){

        $this->validate();

        $penerbit->update([

        'nama' => $this->nama,
        'slug' => Str::slug($this->nama),

        ]);

        session()->flash('Sukses', 'Data berhasil diubah');

        $this->format();

    }

    public function Delete(ModelsPenerbit $penerbit){

        $this->format();

        $this->delete=true;
        $this->penerbit_id = $penerbit->id;   

 }

    public function destroy(ModelsPenerbit $penerbit){

        $buku = Buku::where('penerbit_id',$penerbit->id)->get();
        foreach ($buku as $key => $value){
            $value->update([
                'penerbit_id' => 1
            ]);
        }

    $penerbit->delete();

    session()->flash('Sukses', 'Data berhasil dihapus');

    $this->format();

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.Petugas.penerbit',[
    'penerbit' => ModelsPenerbit::latest()->paginate(10)    
        ]);
    }

    public function format()
    {
        unset($this->create);
        unset($this->nama);
        unset($this->edit);
        unset($this->delete);
        unset($this->penerbit_id);
    }
}
