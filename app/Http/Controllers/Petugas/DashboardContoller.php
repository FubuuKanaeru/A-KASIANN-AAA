<?php

namespace App\Http\Controllers\Petugas;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public $bulan_tahun;
    
    public function __invoke(Request $request)
    {

        $user = User::count();
        $transaksi = Peminjaman::count();
        $jumbuku = Buku::count();
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

        return view('petugas.dashboardpetugas',compact('user','transaksi','jumbuku','count_sedang_dipinjam','count_selesai_dipinjam','count','tanggal_pengembalian'));
    }
    
}