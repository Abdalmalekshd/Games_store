<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Game;
use App\Models\Suggestion;

use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function signup()
    {
        return view('interfaces/Signup');
    }


    public function sign(SignupRequest $req)
    {

        $user = User::create([
            'name' => $req->full_name,
            'email' => $req->email,
            'user_name' => $req->user_name,
            'password' =>  Hash::make($req->password),
        ]);
        $email = User::select('email')->first()->email;
        if ($email == $req->email) {
            return response('Email Already Exist', 401);
        } elseif ($user) {

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




   
    
}
