<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id'; // or null

    public function perusahaan()
    {
    	return $this->belongsToMany('App\Perusahaan');
    	// return $this->belongsToMany('App\Perusahaan')->withPivot('jp_jurusan', 'jp_perusahaan');
    }
}
