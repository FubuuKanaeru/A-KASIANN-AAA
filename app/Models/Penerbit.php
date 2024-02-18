<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;
    protected $table = 'penerbit';
    protected $fillable = ['nama', 'slug'];

    // funcition relasi
    public function buku(){
        return $this->hasMany(Buku::class);
    }

    //muttator
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }

}
