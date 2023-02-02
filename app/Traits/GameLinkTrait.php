<?php

namespace App\Traits;

trait GameLinkTrait
{
    function saveGameLink($Link, $folder)
    {
        $file_ex = $Link->getClientOriginalExtension();
        $Game_Link = time() . '.' . $file_ex;

        $path = $folder;

        $Link->move($path, $Game_Link);

        return  $Game_Link;
    }
}
