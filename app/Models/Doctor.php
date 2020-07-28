<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected  $table="doctors";
    protected  $fillable=['name','title','hostpital_id','medical_id','created_at','updated_at'];
    protected  $hidden=['created_at','updated_at','hospital_id','medical_id','pivot'];
    public $timestamps=true;

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','hostpital_id','id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }

    public function getGenderAttribute($value){
        if($value==1){
            return 'male';
        }else{
            return 'female';
        }
   //   return  $value==1? 'male' : 'female' ;
    }



}
