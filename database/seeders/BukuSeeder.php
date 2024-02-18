<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'PKN',
             'slug' => Str::slug('PKN'),
             'sampul' => 'bukuSampul_novel_Bintang.jpeg',
             'penulis' => 'toya',
             'penerbit_id' => 2,
             'kategori_id' => 2,
             'rak_id' => 2,
             'stok' => 50 

        ]);
        Buku::create([
            'judul' => 'Matematika',
             'slug' => Str::slug('Matematika'),
             'sampul' => 'bukuSampul_novel_Bulan.jpeg',
             'penulis' => 'toya',
             'penerbit_id' => 2,
             'kategori_id' => 2,
             'rak_id' => 3,
             'stok' => 50 
        ]);
       
        
    }
}
