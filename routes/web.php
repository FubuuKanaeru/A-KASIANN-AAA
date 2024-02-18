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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',AnggotaBukuContoller::class);

Auth::routes();

Route::get('/cek-role',CekController::class)->middleware('auth'); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/dashboard', function () {
    return view('petugas/dashboardpetugas');
});

// Role admin dan petugas
Route::middleware(['role:admin|petugas'])->group(function () {

Route::get('/kategori' , KategoriController::class );
Route::get('/rak' , RakController::class );
Route::get('/penerbit' ,PenerbitController::class);
Route::get('/buku' ,BukuController::class);
Route::get('/transaksi' ,TransaksiController::class);
    
});
// anggota
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/keranjang',KeranjangController::class);
});

// admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/user',UserController::class);
});

