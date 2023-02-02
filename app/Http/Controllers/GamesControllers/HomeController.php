<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Traits\GetGameTrait;
use App\Traits\SerachTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Illuminate\Support\Facades\DB;;

class HomeController extends Controller
{
    use SerachTrait;
    use GetGameTrait;
    //Get All Games And Show It In The Home Page
    public function home()
    {
        $game = Game::select(
            'id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo',
            'rating'
        )->paginate(5);
        $gameser='';
        return view('interfaces/UserHome',compact('game','gameser'));
    }

    public function serachfor(REQUEST $req){

        $game = Game::select(
            'id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo',
            'rating'
        )->paginate(5);
        // return $this->serachfor($req->serach);
            $gameser = Game::select('id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo')->where(DB::raw('concat(game_name_ar," ",game_name_en)') , 'LIKE' , '%' . $req->serach . '%')->get();

        return view('interfaces/UserHome',compact('game','gameser'));
        }

        public function HorrorCate(){

            $game=$this->GetGame(1);

            return view('interfaces/UserGameCategoy',compact('game'));
        }


        public function ActionCate(){

            $game=$this->GetGame(2);

            return view('interfaces/UserGameCategoy',compact('game'));
        }



        public function AdventureCate(){

            $game=$this->GetGame(3);

            return view('interfaces/UserGameCategoy',compact('game'));
        }

        public function SurvivalCate(){

            $game=$this->GetGame(4);

            return view('interfaces/UserGameCategoy',compact('game'));
        }

}
