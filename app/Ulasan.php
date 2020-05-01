<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'ulasan_id'; // or null
    protected $fillable = ['ulasan_id','ulasan_nama_mhs','ulasan_jurusan_id','ulasan_angkatan','ulasan_perusahaan_id','ulasan_periode','ulasan_testimoni'];

    public function Jurusan()
    {
    	return $this->belongsTo('App\Jurusan','ulasan_jurusan_id','jurusan_id');
    }
    public function Perusahaan()
    {
    	return $this->belongsTo('App\Perusahaan','ulasan_perusahaan_id','perusahaan_id');
    }
}
