<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    //

    public  function hasOneRelation(){
        $user=User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])->find(4);

      //  $user=User::with('phone')->find(4);
        return response()->json($user);
    }

    public  function GetUserHasPhone(){
        $user=User::whereHas('phone',function ($q){
            $q->where('code','+02');
        })->get();
        return $user;
    }

    public  function GetUserNotHasPhone(){
        $user=User::whereDoesntHave('phone')->get();
        return $user;
    }
}
