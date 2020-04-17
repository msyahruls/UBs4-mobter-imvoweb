<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'perusahaan_id'; // or null

    public function jurusan()
    {
    	return $this->belongsToMany('App\Jurusan');
    	// return $this->belongsToMany('App\Jurusan')->withPivot('jp_jurusan', 'jp_perusahaan');
    }
}
