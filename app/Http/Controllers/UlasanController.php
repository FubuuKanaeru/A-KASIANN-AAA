<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use FontLib\Table\Type\fpgm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UlasanController extends Controller
{

 public function index($id){
    {
    $ulasan = Buku::where('id',$id)->get();
    $data = Buku::all();
     return view('ulasan/ulasan', compact('data','ulasan'));
    }
}
 public function ulasan(){
    {
    $data = Ulasan::all();
     return view('ulasan.semuaulasan',compact('data'));
    }
}
public function store(Request $request,$id){

        $request->validate([
            'ulasan'=>'required'
        ]);
    $data = [
        'anggota_id' => auth()->user()->id,
        'buku_id' => $id,
        'ulasan' =>$request->ulasan 
   ];

   Ulasan::create($data);
    return Redirect('keranjang/');
// return redirect('/ulasan/')->with('succes','Data Berhasil Disimpan');
}

    public function delete(Request $request,$id){
        
        $data = Ulasan::find($id);

        if($data){
            $data->delete();
        }
        return redirect('/');
    }

}