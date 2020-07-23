<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function admin_login(){
        return view('auth.adminlogin');
    }

    public function checkadminlogin(Request $request){
        return "ok";

        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required:min:6'
        ]);

        if (Auth::guard('admin')->attemp(['email' => $request->email, 'password' => $request->password])) {
            return "ok";
          //  return redirect()->intended('/admin');
        }else{
            return "false";
        }
        return back()->withInput($request->only('email'));

    }


}
