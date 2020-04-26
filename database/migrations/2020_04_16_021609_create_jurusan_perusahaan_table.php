<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusanPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan_perusahaan', function (Blueprint $table) {
            $table->id('jp_id');
            $table->bigInteger('jp_perusahaan')->index()->unsigned()->nullable();
            $table->bigInteger('jp_jurusan')->index()->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('jp_perusahaan')->references('perusahaan_id')->on('perusahaan')->onDelete('cascade');
            $table->foreign('jp_jurusan')->references('jurusan_id')->on('jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurusan_perusahaan');
    }
}
