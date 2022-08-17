<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class TemplateController extends Controller
{
    //
    public function index(Request $req)
    {
        // $req->session()->pull('login_user',null);
        // $req->session()->put('login_user',Auth::user());
     	return view('Frontend.home');
    }
   public function logout(Request $request) 
   {
    Auth::logout();
    // $req->session()->pull('login_user',null);
    return redirect('/');
   }
}
