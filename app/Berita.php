<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    public $primaryKey ='berita_id';

    protected $fillabel =[
        'kategori_id',
        'berita_judul',
        'berita_slug',
        'tanggal_post',
        'berita_deskripsi'
    ];
}
