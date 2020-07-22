<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class CustomAuthController extends Controller
{

    public function Adult()
    {
    return view('customAuth.index');
      //  return view('site');
    }

    public function site()
    {
        return view('site');

    }

    public function admin()
    {
        return view('admin');
    }



}
