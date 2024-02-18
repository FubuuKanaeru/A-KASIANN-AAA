<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TransaksiController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(){
        $dtuser = User::with('nama')->get();
        return view('petugas/transaksi/index',compact('dtuser'));

    }

    public function __invoke(Request $request)
    {
        return view('petugas/transaksi/index');
    }
}
