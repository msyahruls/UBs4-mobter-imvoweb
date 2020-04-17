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
            ['jp_perusahaan' => '1',    'jp_jurusan' => '1'],
            ['jp_perusahaan' => '1',   	'jp_jurusan' => '2'],
            ['jp_perusahaan' => '1',	'jp_jurusan' => '3'],
            ['jp_perusahaan' => '1',    'jp_jurusan' => '4'],
            ['jp_perusahaan' => '1',   	'jp_jurusan' => '5'],

            ['jp_perusahaan' => '2',	'jp_jurusan' => '6'],
            ['jp_perusahaan' => '2',    'jp_jurusan' => '10'],

            ['jp_perusahaan' => '3',    'jp_jurusan' => '11'],
            ['jp_perusahaan' => '3',   	'jp_jurusan' => '12'],
            ['jp_perusahaan' => '3',	'jp_jurusan' => '5'],
            ['jp_perusahaan' => '3',    'jp_jurusan' => '9']
        ];

        foreach ($listJurPer as $jurper) {
            JurusanPerusahaan::create($jurper);
        }
    }
}
