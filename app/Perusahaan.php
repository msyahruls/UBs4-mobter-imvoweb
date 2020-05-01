<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'perusahaan_id'; // or null
    protected $fillable = ['perusahaan_id','perusahaan_nama','perusahaan_alamat','perusahaan_email','perusahaan_telepon','perusahaan_logo','perusahaan_gambar1','perusahaan_gambar2','perusahaan_gambar3'];

    public function jurusan()
    {
    	return $this->belongsToMany('App\Jurusan','jurusan_perusahaan','jp_perusahaan','jp_jurusan');
    	// return $this->belongsToMany('App\Jurusan')->withPivot('jp_jurusan', 'jp_perusahaan');
    }
}
