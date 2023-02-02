<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Game;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends Controller
{
    public function Dashboard(){

 $user=User::get();
  $countUsers=User::count();
  $game = Game::select(
    'id',
    'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
)->get();
  $countGames=Game::count();

   $Sugg=Suggestion::with('User')->get();


        return view('interfaces/dashboard',compact('user','countUsers','game','countGames','Sugg'));
    }

    public function Dlt($Game_id){

        $dltsugg=Suggestion::Find($Game_id)->delete();

    }
}
