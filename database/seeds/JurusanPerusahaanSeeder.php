<?php

use Illuminate\Database\Seeder;
use App\JurusanPerusahaan;

class JurusanPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listJurPer = [
            ['perusahaan_perusahaan_id' => '1',    'jurusan_jurusan_id' => '1'],
            ['perusahaan_perusahaan_id' => '1',   	'jurusan_jurusan_id' => '2'],
            ['perusahaan_perusahaan_id' => '1',	'jurusan_jurusan_id' => '3'],
            ['perusahaan_perusahaan_id' => '1',    'jurusan_jurusan_id' => '4'],
            ['perusahaan_perusahaan_id' => '1',   	'jurusan_jurusan_id' => '5'],

            ['perusahaan_perusahaan_id' => '2',	'jurusan_jurusan_id' => '6'],
            ['perusahaan_perusahaan_id' => '2',    'jurusan_jurusan_id' => '10'],

            ['perusahaan_perusahaan_id' => '3',    'jurusan_jurusan_id' => '11'],
            ['perusahaan_perusahaan_id' => '3',   	'jurusan_jurusan_id' => '12'],
            ['perusahaan_perusahaan_id' => '3',	'jurusan_jurusan_id' => '5'],
            ['perusahaan_perusahaan_id' => '3',    'jurusan_jurusan_id' => '9']
        ];

        foreach ($listJurPer as $jurper) {
            JurusanPerusahaan::create($jurper);
        }
    }
}
