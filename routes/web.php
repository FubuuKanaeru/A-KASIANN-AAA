<?php

use App\Http\Controllers\Anggota\BukuController as AnggotaBukuContoller;
use App\Http\Controllers\Anggota\KeranjangController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\CekController;
use App\Http\Controllers\Petugas\RakController;
use App\Http\Controllers\Petugas\PenerbitController;
use App\Http\Controllers\Petugas\BukuController;
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardpetugasContoller;
use App\Http\Controllers\LaporanContoller;
use App\Http\Controllers\Petugas\ChartController;
use App\Http\Controllers\Petugas\DashboardContoller;
use App\Http\Controllers\Petugas\UlasanController as PetugasUlasanController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/',AnggotaBukuContoller::class);

Auth::routes();

Route::middleware(['auth'])->group(function() {

    Route::get('/cek-role',CekController::class)->middleware('auth'); 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
    
    // Dashboard
    Route::get('/dashboard',[DashboardpetugasContoller::class,'dashboard']);
    Route::get('/coba',[DashboardpetugasContoller::class,'Coba']);

    // Role admin dan petugas
    Route::middleware(['role:admin|petugas'])->group(function () {
    // CRUD ROLE
   
    // Route::get('/dashboard' , DashboardContoller::class );
    Route::get('/kategori' , KategoriController::class );
    Route::get('/rak' , RakController::class );
    Route::get('/penerbit' ,PenerbitController::class);
    Route::get('/buku' ,BukuController::class);
    Route::get('/transaksi' ,TransaksiController::class);
    Route::get('/Chart' ,ChartController::class);
    Route::get('/ulasan' ,PetugasUlasanController::class);

    // Generate Laporan buku
    Route::get('/pdf/buku/laporan',[LaporanContoller::class,'bukupdf']);
    Route::get('/pdf/buku/laporan/pdf',[LaporanContoller::class,'generatebuku'])->name('pdf.laporan');
        
    // Generate transaksi laporan
    Route::get('/pdf/transaki/laporan',[LaporanContoller::class,'generatetransaksi'])->name('pdf.transaksi');
    Route::get('/pdf/transaksi/laporan',[LaporanContoller::class,'transaksilaporan']);
    // ulasan
    Route::get('/dashboard/ulasan',[UlasanController::class,'ulasan']);
    Route::delete('/dashboard/delete/{$id}',[UlasanController::class,'delete']);
    Route::get('/dashboard',[DashboardpetugasContoller::class,'dashboard']);
        
    });
    
    // Role anggota
    Route::middleware(['auth', 'role:anggota'])->group(function () {
        Route::get('/keranjang',KeranjangController::class);
        Route::get('/ulasan/{id}',[UlasanController::class,'index']);
    // ulasan buku
    route::post('/ulasan/store/{id}',[UlasanController::class,'store']);
    });
    
    // Role admin
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Route::get('/user',UserController::class);
        Route::resource('/user',App\Http\Controllers\Admin\UserController::class);
        // Route::resource('/user'[App\Http\Controllers\PermissionController::class]);
    });

});



