<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_category extends Model
{
   
    protected $table = "tabel_category";
    protected $primaryKey = 'id';
    protected $fillable = ['id_category','category'];
       
}