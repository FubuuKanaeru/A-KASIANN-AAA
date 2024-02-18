<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    
    protected $table = 'kategori';
    protected $fillable = ['name','slug'];

    public function Rak(){
        return $this->hasMany(Rak::class);
    }

    public function Buku()
    {
        return $this->hasMany(Buku::class);
    }

    //mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }


}
