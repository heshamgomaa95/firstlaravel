<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table="admins";
    protected $fillable=['name','Email','password'];  //any thing this array can be insert in database
    protected $hidden = ['password'];

    public $timestamps=false;   ///  add times in table in insert or update
}
