<?php

use Illuminate\Database\Seeder;
use App\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $listJurusan = [
            'Sarjana Akuntansi',                     
            'Ekonomi Pembangunan',                   
            'Manajemen',                             
            'Ekonomi Islam',                         
            'Kewirausahaan',                         
            'Ekonomi, Keuangan, dan Perbankan',      

            'Ilmu Hukum',                            

            'Ilmu Administrasi Publik',              
            'Ilmu Administrasi Bisnis',              
            'Perpajakan',                            
            'Ilmu Perpustakaan',                     
            'Pariwisata',                            
            'Administrasi Pendidikan',               

            'Sastra Inggris',                        
            'Sastra Jepang',                         
            'Bahasa dan Sastra Perancis',            
            'Sastra Cina',                           
            'Pendidikan Bahasa dan Sastra Indonesia',
            'Pendidikan Bahasa Inggris',             
            'Pendidikan Bahasa Jepang',              
            'Seni Rupa Murni',                       
            'Antropologi Sosial',                    

            'Manajemen Sumberdaya Perairan',         
            'Budidaya Perairan',                     
            'Teknologi Hasil Perikanan',             
            'Pemanfaaatan Sumberdaya Perikanan',     
            'Ilmu Kelautan',                         
            'Agrobisnis Perikanan'               
        ];

        foreach ($listJurusan as $jurusan) {
            Jurusan::create(['jurusan_nama' => $jurusan]);
        }
    }
}
