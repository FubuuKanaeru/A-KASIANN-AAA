<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPeminjaman;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Faker\Factory;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i=0; $i < 500; $i++){
            $faker = Factory::create('id_ID');
            $tanggal_pinjam = $faker->dateTimeBetween('-10 months', '-2 week');
            $tanggal_kembali = Carbon::parse($tanggal_pinjam)->addDays(10);
            $tanggal_pengembalian = Carbon::parse($tanggal_pinjam)->addDays(10);

            $user = User::create([
                'name' =>  $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('11223344'),
            ]);


            $peminjaman  = Peminjaman::create([
                'kode_pinjam' => random_int(100000000, 999999999),
                'anggota_id' => $user->id,
                'petugas_pinjam' => random_int(1,2),
                'petugas_kembali' => random_int(1,2),
                'denda' => 0,
                'status' => 3,
                'tanggal_pinjam' => $tanggal_pinjam,
                'tanggal_kembali' => $tanggal_kembali,
                'tanggal_pengembalian' => $tanggal_pengembalian,
            ]);            

            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => random_int(1,7),
            ]);
        }
    }
}
