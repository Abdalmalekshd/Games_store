<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Game;
use App\Models\Suggestion;
class LoginController extends Controller
{
    //user login
    public function Login()
    {
        return view('interfaces/Login');
    }



    public function Signin(Request $req)
    {

        $data=['email'=>$req->email,
        'password'=>$req->password];
        if (Auth::guard('web')->attempt($data)) {

            return redirect()->intended(route('home'));
        }
        return redirect()->back()->withInput($req->only('email'));
        
        

    }
    
    //Admin Login 
    
    public function Adminlogin()
    {
        return view('interfaces/AdminLogin');
    }


    public function AdminSignin(Request $req)
    {
        $this->validate($req, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        $data=['email'=>$req->email,
    'password'=>$req->password];
        if (Auth::guard('admin')->attempt($data)) {

            return redirect()->intended(route('Dashboard'));
        }
        // return redirect()->back()->withInput($req->only('email'));


        

    }


    //Begin Logout Function
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
