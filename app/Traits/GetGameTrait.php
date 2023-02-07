<?php

namespace App\Traits;
use Illuminate\Http\Request;

use App\Models\Game;
Use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait GetGameTrait
{
    function GetGame($catnum = 0)
    {
        $game = Game::select(
            'id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo',
            
        )->Where('game_category_en','=',$catnum)->get();

        return $game;
    }
}
