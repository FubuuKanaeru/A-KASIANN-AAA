<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Rak;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanContoller extends Controller
{
    public function bukulaporan(){

        $buku = Buku::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        return view('laporan.laporan', compact('buku'));
    }

    public function bukupdf(){

        $buku = Buku::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        return view('laporan.laporan', compact('buku'));
    }

    public function generatebuku(){

        $buku = Buku::all();

        $pdf = Pdf::loadView('laporan.pdf.bukupdf' ,compact('buku'));
        return $pdf->stream('lapoaran buku.pdf');

    }
    

    public function transaksilaporan(){

        $peminjaman = Peminjaman::all();
        $user = User::all();
        $detailpeminjaman = DetailPeminjaman::all();    

        return view('laporan.laporantransaksi',compact('peminjaman','detailpeminjaman'));

    }

    public function generatetransaksi(){    

        $peminjaman = Peminjaman::all();
        $user = User::all();
        $detailpeminjaman = DetailPeminjaman::all();    

        $pdf = Pdf::loadView('laporan\pdf\transaksipdf',compact('peminjaman','user','detailpeminjaman'));
        return $pdf->stream('lapoaran Transaksi.pdf');

    }

    public function report(Request $request)
    {
        $user = User::all();
        $detailpeminjaman = DetailPeminjaman::all();   
        
        if($request->has('tanggal_pinjam')){
            $peminjaman = Peminjaman::whereBetween('tanggal_pinjam',[$request->tanggal_pinjam, $request->end_date])->paginate();
        }else{
            $peminjaman = Peminjaman::paginate();
        }
        return view('laporan.laporantransaksi',compact('user','detailpeminjaman','peminjaman'));

    }
}
