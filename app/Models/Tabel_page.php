<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_page extends Model
{
   
    protected $table = "tabel_page";
    protected $primaryKey = 'id';
    protected $fillable = ['id_page','page'];
       
}