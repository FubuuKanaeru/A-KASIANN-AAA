<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable =['kode_pinjam','anggota_id','petugas_pinjam','petugas_kembali','status','denda','tanggal_pinjam','tanggal_kembali','tanggal_pengembalian'];

    // relasi
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // recessor
    public function getDendaAttribute($value)
    {
        return $value ? "Rp. {$value}" : '-';
    }
    public function gettanggalPinjamAttribute($value)
    {
        return Carbon::create($value)->format('d-m-Y');
    }
    public function gettanggalKembaliAttribute($value)
    {
        return Carbon::create($value)->format('d-m-Y');
    }


}
