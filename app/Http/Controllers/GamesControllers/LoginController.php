<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Game;
class LoginController extends Controller
{
    public function Login()
    {
        return view('interfaces/Login');
    }



    public function Signin(Request $req)
    {

        $users = User::where([
            ['email', '=', $req->email],
            ['password', '=', sha1($req->password)],

        ])->get();


        if (count($users) > 0) {

            session(['user_id' => $users[0]->id]);
            $game = Game::select(
                'id',
                'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
                'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
                'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
                'photo'
            )->get();
            return view('interfaces/UserHome',compact('game'));
        }

    }




    //Begin Logout Function
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
