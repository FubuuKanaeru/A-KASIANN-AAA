<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Livewire\Petugas\Transaksi;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Rak;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Roleseeder::class,
            Userseeder::class,
            Kategoriseeder::class,
            Rakseeder::class,
            Bukuseeder::class,
            Penerbitseeder::class,
            TransaksiSeeder::class
        ]);
    }
}
