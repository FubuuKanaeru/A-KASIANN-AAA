<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User as MOdelsuser;
use Illuminate\Validation\Rules\Password;

class User extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $admin,$petugas,$anggota,$search ,$user1,$edit,$role,$delete;
    public $create ,$nama ,$email ,$password ,$password_confirmation ,$user_id ,$name;

    protected $validationAttributes = [
        'name' => 'nama',
        'password_confirmation' => 'ulangi password'
    ];

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'roles' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => 'required',
        ];
    }

    public function mount(MOdelsuser $user){
        $this->user1 = $user;
    }

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

    public function Create()
    {
        $this->create = true;

    }

    public function store(){
        
        $this->validate();
        
        $user = MOdelsuser::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        
        if ($this->admin) {
            $user->assignRole('admin');
        }
        elseif ($this->petugas) {
            $user->assignRole('petugas');
        } else {
            $user->assignRole('anggota');
        }
        session()->flash('Sukses', 'User berhasil ditambahkan');
        $this->format();
    }


    public function Edit(MOdelsuser $user){

        $this->format();
        $this->edit = true;
        $this->user1 = $user;
        $this->user_id = $user->id;
        $this->nama = $user->name;
        $this->email = $user->email;
        
    }
    public function update(MOdelsuser $user){
    
        $this->validate();
    
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
        
        session()->flash('Sukses', 'Data berhasil diperbarui');
    
        $this->format();
    
    }

    public function Delete(MOdelsuser $user){

        $this->format();

        $this->delete = true;
        $this->user_id = $user->id; 
        $this->nama = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;

    }
    public function destroy(MOdelsuser $user)
    {
    
        $user->delete();

        session()->flash('Sukses', 'Data berhasil dihapus.');
        $this->format();
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
        unset($this->create);
        unset($this->delete);
        unset($this->edit);
        unset($this->name);
        unset($this->email);
        unset($this->password);
        unset($this->password_confirmation);
    }
}
