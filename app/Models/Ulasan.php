<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    
    protected $table = 'ulasan';
    protected $fillable = ['anggota_id','buku_id','ulasan'];

    public function anggota()
    {
        return $this->belongsTo(User::class);
    }

    public function buku() 
    {
        return $this->belongsTo(Buku::class);    
    }
}
