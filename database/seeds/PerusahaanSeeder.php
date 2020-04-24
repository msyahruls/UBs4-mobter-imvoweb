<?php

use Illuminate\Database\Seeder;
use App\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $listPerusahaan = [
            ['perusahaan_nama' => 'PT Apa adanya',  'perusahaan_alamat' => 'Jl Mega Mendem no 10, Surabaya',            'perusahaan_email' => 'apada@email.com',	'perusahaan_telepon' => '01237694198', 'perusahaan_logo' => '1.jpg', 'perusahaan_gambar1' => '2.jpg', 'perusahaan_gambar2' => '3.jpg', 'perusahaan_gambar3' => '4.jpg'],
            ['perusahaan_nama' => 'PT Adi daya',   	'perusahaan_alamat' => 'Perum Pantang Buka no 14, Mojokerto',       'perusahaan_email' => 'adiday@email.com', 	'perusahaan_telepon' => '0768914232', 'perusahaan_logo' => '2.jpg', 'perusahaan_gambar1' => '3.jpg', 'perusahaan_gambar2' => '4.jpg', 'perusahaan_gambar3' => '1.jpg'],
            ['perusahaan_nama' => 'CV Maju mundur',	'perusahaan_alamat' => 'Jl Planet Kentang Selatan no 106, Malang',  'perusahaan_email' => 'mamun@email.com',    'perusahaan_telepon' => '01267397123', 'perusahaan_logo' => '3.jpg', 'perusahaan_gambar1' => '4.jpg', 'perusahaan_gambar2' => '1.jpg', 'perusahaan_gambar3' => '2.jpg'],
            ['perusahaan_nama' => 'Kominfo', 		'perusahaan_alamat' => 'Jl Kutaktaulagi gg 9 no 333, Batu',         'perusahaan_email' => 'kominfo@email.com',  'perusahaan_telepon' => '0982739813', 'perusahaan_logo' => '4.jpg', 'perusahaan_gambar1' => '1.jpg', 'perusahaan_gambar2' => '2.jpg', 'perusahaan_gambar3' => '3.jpg'],
            ['perusahaan_nama' => 'Pantai Photo',   'perusahaan_alamat' => 'Jl Patimura Merdeka no 01, Bali',           'perusahaan_email' => 'panpot@email.com', 	'perusahaan_telepon' => '072103782103', 'perusahaan_logo' => '1.jpg', 'perusahaan_gambar1' => '4.jpg', 'perusahaan_gambar2' => '2.jpg', 'perusahaan_gambar3' => '3.jpg']
        ];

        foreach ($listPerusahaan as $perusahaan) {
            Perusahaan::create($perusahaan);
        }
    }
}
