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
    

    // transaksi
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
}
