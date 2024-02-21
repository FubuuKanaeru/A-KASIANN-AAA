<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;


class DashboardpetugasContoller extends Controller
{
    public function dashboard(){
        $user = User::count();
        $transaksi = Peminjaman::count();
        $jumbuku = Buku::count();
        return view('petugas.dashboardpetugas',compact('user','transaksi','jumbuku'));
    }

    public function Coba(){

        return view('home');
    }

}
