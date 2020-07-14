<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name','price','details','created_at','updated_at'];  //any thing this array can be insert in database
    protected $hidden=['created_at','updated_at'];// when select database this arrary hidden colum don't show
    public $timestamps=true;   ///  add times in table in insert or update
}
