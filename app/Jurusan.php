<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id'; // or null

    protected $fillable = [
        'jurusan_nama'
    ];

    public function perusahaan()
    {
    	return $this->belongsToMany('App\Perusahaan');
    }
}
