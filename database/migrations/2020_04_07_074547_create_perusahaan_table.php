<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('perusahaan_id');
            $table->string('perusahaan_nama');
            $table->string('perusahaan_alamat');
            $table->string('perusahaan_email');
            $table->string('perusahaan_telepon');
            $table->binary('perusahaan_logo')->nullable();
            $table->binary('perusahaan_gambar1')->nullable();
            $table->binary('perusahaan_gambar2')->nullable();
            $table->binary('perusahaan_gambar3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaan');
    }
}
