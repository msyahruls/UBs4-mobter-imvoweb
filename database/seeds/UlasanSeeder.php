<?php

use Illuminate\Database\Seeder;
use App\Ulasan;
class UlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $listUlasan = [
            ['ulasan_nama_mhs' => 'Ahmad Doni',  
              'ulasan_jurusan_id' => '1', 
              'ulasan_angkatan' => '2015',
              'ulasan_perusahaan_id' => '1',
              'ulasan_periode' => '5 Bulan',
              'ulasan_testimoni' => 'Mantap'
          	],

            ['ulasan_nama_mhs' => 'Muhammad Rashford',  
              'ulasan_jurusan_id' => '2', 
              'ulasan_angkatan' => '2016',
              'ulasan_perusahaan_id' => '2',
              'ulasan_periode' => '5 Bulan',
              'ulasan_testimoni' => 'Asekkk'
          	],

            ['ulasan_nama_mhs' => 'Kurniawan Figo',  
              'ulasan_jurusan_id' => '3', 
              'ulasan_angkatan' => '2017',
              'ulasan_perusahaan_id' => '3',
              'ulasan_periode' => '4 Bulan',
              'ulasan_testimoni' => 'Veri Nice'
          	],

            ['ulasan_nama_mhs' => 'Ehsan Fizi',  
              'ulasan_jurusan_id' => '4', 
              'ulasan_angkatan' => '2015',
              'ulasan_perusahaan_id' => '4',
              'ulasan_periode' => '5 Bulan',
              'ulasan_testimoni' => 'Recommended'
          	],

            ['ulasan_nama_mhs' => 'Ismail bin Mail',  
              'ulasan_jurusan_id' => '5', 
              'ulasan_angkatan' => '2016',
              'ulasan_perusahaan_id' => '5',
              'ulasan_periode' => '5 Bulan',
              'ulasan_testimoni' => 'Josss'
          	]
        ];

        foreach ($listUlasan as $ulasan) {
            Ulasan::create($ulasan);
        }
    }
}
