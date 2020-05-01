<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 		
 		$faker = Faker::create('id_ID');
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    	for($i = 1; $i <= 10; $i++)
        {
    		DB::table('berita')->insert([
    			'berita_judul' => $faker->text,
    			'berita_link' => $faker->url,
                'berita_gambar' => $faker->picsum('public/images/berita',400,400, false)
    		]);
    	}
    }
}
