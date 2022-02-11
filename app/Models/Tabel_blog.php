<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_blog extends Model
{
   
    protected $table = "tabel_blog";
    protected $primaryKey = 'id';
    protected $fillable = ['id_blog','blog'];
       
}