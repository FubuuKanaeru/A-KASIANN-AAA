<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\DB;

class DashboardpetugasContoller extends Controller
{
    // count
    public function dashboard(){

        $user = User::count();
        $transaksi = Peminjaman::count();
        $jumbuku = Buku::count();
        $ulasan = Ulasan::count();
        $count_sedang_dipinjam = Peminjaman::where('status',2)->count();
        $count_selesai_dipinjam =  Peminjaman::where('status',3)->count();

        // Chart
        $bulan = substr(now(),-2);
        $tahun = substr(now(), 0, 4);

        $selesai_dipinjam = Peminjaman::select(DB::raw('count(*) as count, tanggal_pengembalian'))
        ->groupBy('tanggal_pengembalian')
        ->whereMonth('tanggal_pengembalian', $bulan)
        ->whereYear('tanggal_pengembalian', $tahun)
        ->where('status',3)
        ->get();

        $hari_per_bulan = Carbon::parse(now())->daysInMonth;

        $tanggal_pengembalian = [];
        $count = [];
        for ($i=1; $i <= $hari_per_bulan; $i++) { 
            for ($j=0; $j < count($selesai_dipinjam); $j++) { 
                if (substr($selesai_dipinjam[$j]->tanggal_pengembalian, -2) == $i) {
                    $tanggal_pengembalian[$i] = substr($selesai_dipinjam[$j]->tanggal_pengembalian, -2);
                    $count[$i] = $selesai_dipinjam[$j]->count;
                    break;
                }else {
                    $tanggal_pengembalian[$i] = $i;
                    $count[$i] = 0;
                }
            }
            
        }

        // Terbaru
        $buku = Buku::limit(5)->latest()->get();
        $user1 = User::role('anggota')->limit(5)->latest()->get();
        $sedang_dipinjam = Peminjaman::where('status',2)->limit(5)->latest()->get();
        $selesai_dipinjam =  Peminjaman::where('status',3)->limit(5)->latest()->get();


        return view('petugas.dashboardpetugas',
        compact('user','transaksi','jumbuku','count_sedang_dipinjam',
        'count_selesai_dipinjam',
        'count','tanggal_pengembalian',
        'sedang_dipinjam','selesai_dipinjam',
        'buku','user1','ulasan'



));

   

}
}