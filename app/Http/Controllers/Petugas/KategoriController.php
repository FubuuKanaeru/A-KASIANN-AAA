<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

use function Laravel\Prompts\search;

class KategoriController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        if (request('search')) {
            $kategori = Kategori::where('name', 'LIKE', '%' . request('search') . '%')->paginate(5);
        } else {
            $kategori = Kategori::latest()->paginate(10);
        }
        return view('livewire.petugas.kategori',compact('kategori')); 
     }

     
    public function view_pdf()
    {
        $kategori = Kategori::all();
        return view ('pdf.laporan')->with('kategori', $kategori);
    }


    public function __invoke(Request $request)
    {

        return view('petugas/kategori/index');
    }
}
