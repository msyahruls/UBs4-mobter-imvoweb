<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'berita_id'; // or null
    protected $fillable = ['berita_judul','berita_link','berita_gambar'];

}
