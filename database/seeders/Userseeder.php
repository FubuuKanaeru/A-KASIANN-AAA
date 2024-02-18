<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('admin');

        User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('petugas');

        User::create([
            'name' => 'anggota',
            'email' => 'anggota@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('anggota');

        User::create([
            'name' => 'ilham',
            'email' => 'ilham@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('anggota');

        User::create([
            'name' => 'nara',
            'email' => 'nara@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('anggota');

        User::create([
            'name' => 'syah',
            'email' => 'syah@gmail.com',
            'password' => bcrypt('11223344'),
            'email_verified_at' => now()
        ])->assignRole('anggota');
    }
}
