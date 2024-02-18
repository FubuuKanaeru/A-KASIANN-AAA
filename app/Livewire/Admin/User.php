<?php

namespace App\Livewire\Admin;

use App\Models\User as MOdelsuser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $admin,$petugas,$anggota,$search;
    public $create;

    public function Admin()
    {
        $this->format();
        $this->admin = true;
    }

    public function Petugas()
    {
        $this->format();
        $this->petugas = true;
    }

    public function Anggota()
    {
        $this->format();
        $this->anggota = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->create = true;
        dd('absuygiuyava');
    }
 
    
    public function render()
    {

        if ($this->search) {
            if ($this->admin) {
                $user = ModelsUser::role('admin')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
            } elseif ($this->petugas) {
                $user = ModelsUser::role('petugas')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
            } elseif($this->anggota) 
                $user = ModelsUser::role('anggota')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
            else {
                $user = ModelsUser::where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
            }
        } else {
            if ($this->admin) {
                $user = ModelsUser::role('admin')->paginate(5);
            } elseif ($this->petugas) {
                $user = ModelsUser::role('petugas')->paginate(5);
            } elseif($this->anggota) {
                $user = ModelsUser::role('anggota')->paginate(5);
            }else {
                $user = ModelsUser::paginate(5);
            }
            
        }
        
        return view('livewire.admin.user',compact('user'));
    }

    public function format() {
        $this->admin = false;
        $this->petugas = false;
        $this->anggota = false;
    }
}
