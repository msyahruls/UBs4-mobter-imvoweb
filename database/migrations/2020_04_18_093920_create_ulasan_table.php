<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('ulasan_id');
            $table->string('ulasan_nama_mhs');
            $table->bigInteger('ulasan_jurusan_id')->unsigned()->nullable();
            $table->string('ulasan_angkatan');
            $table->bigInteger('ulasan_perusahaan_id')->unsigned()->nullable();
            $table->string('ulasan_periode');
            $table->string('ulasan_testimoni', 1500);
            $table->timestamps();

            $table->foreign('ulasan_jurusan_id')->references('jurusan_id')->on('jurusan')->onDelete('cascade');

            $table->foreign('ulasan_perusahaan_id')->references('perusahaan_id')->on('perusahaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
}
