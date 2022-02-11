<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_user extends Model
{
   
    protected $table = "tabel_user";
    protected $primaryKey = 'id';
    protected $fillable = ['id_user','nama','alamat','password'];
       
}