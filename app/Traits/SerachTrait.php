<?php

namespace App\Traits;
Use App\Models\Game;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Use Illuminate\Support\Facades\DB;

trait SerachTrait
{
    function serachfor($serach)
    {
        $gameser=Game::select('id',
        'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
        'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
        'photo')->where(DB::raw('concat(game_name_ar," ",game_name_en)') , 'LIKE' , '%' . $serach->serach . '%')->get();

        return $gameser;

    }
}
