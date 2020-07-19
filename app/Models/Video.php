<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="videos";
    protected $fillable=['name','view'];  //any thing this array can be insert in database
    public $timestamps=false;   ///  add times in table in insert or update}
}
