<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
   public $primaryKey = 'kategori_id';

   protected $fillabel='kategori_nama';
}
