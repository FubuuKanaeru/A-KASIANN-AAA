<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penerbit = ['none','erlangga','gramadeia'];

        foreach ($penerbit as $key => $value){
            Penerbit::create([
                'nama' => $value,
            'slug' => Str::slug($value)
        ]);

        }
       
    }
}
