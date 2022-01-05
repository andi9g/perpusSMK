<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\buku;
use App\Models\anggota;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class anggotaFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=1; $i <= 50 ; $i++) { 
            // anggota::insert([
            //     'nis' => rand(10000,99999),
            //     'namaAnggota' => $faker->name,
            //     'id_jurusan' => 1,
            //     'password' => Hash::make('perpus12345'),
            //     'noHp' => rand(100000,999999)
            // ]);
            
            buku::insert([
                'kd_buku' => rand(10,9999),
                'judul_buku' => $faker->name,
                'pengarang' => $faker->name,
                'penerbit' => $faker->name,
                'tahun' => rand(1999,2021),
                'jenis_buku' => 'majalah',
                'lokasi_rak' => 'A',
                'stok' => rand(10,100)
            ]);

        }
    }
}
