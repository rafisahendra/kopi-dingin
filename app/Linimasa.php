<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linimasa extends Model
{
    // protected $table = 'linimasas';
    // public $incrementing = false;
    // protected $primaryKey = 'flight_id';
    // protected $keyType = 'string';
    // public $timestamps = false;
    // protected $dateFormat = 'U';
    public $primaryKey = 'linimasa_id';

    protected $fillable = [
        'linimasa_judul',
    	'linimasa_gambar'
    ];
}
