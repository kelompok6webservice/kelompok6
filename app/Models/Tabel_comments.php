<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_comments extends Model
{
   
    protected $table = "tabel_comments";
    protected $primaryKey = 'id';
    protected $fillable = ['id_comments','comments'];
       
}