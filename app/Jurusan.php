<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id'; // or null
    protected $fillable = ['jurusan_id','jurusan_nama'];

    public function perusahaan()
    {
    	return $this->belongsToMany('App\Perusahaan','jurusan_perusahaan','jp_jurusan','jp_perusahaan');
    }

    public function ulasan()
    { 
      	return $this->hasMany('App\Ulasan','ulasan_jurusan_id','jurusan_id'); 
	}
}
