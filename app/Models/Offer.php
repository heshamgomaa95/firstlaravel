<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name','price','details','photo','status','created_at','updated_at'];  //any thing this array can be insert in database
    protected $hidden=['created_at','updated_at'];// when select database this arrary hidden colum don't show
    public $timestamps=true;   ///  add times in table in insert or update



    //register globalScope
    protected static function boot(){
        parent::boot();
        static ::addGlobalScope(new OfferScope);
    }


    ///mutators

    public function setNameAttribute($value){
        $this ->attributes['name']=strtoupper($value);
    }




    /*public function scopeInactive($query){
        return $query->where('status','=','0');
    }*/
}
