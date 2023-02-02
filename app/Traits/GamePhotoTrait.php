<?php

namespace App\Traits;

trait GamePhotoTrait
{
    function saveImage($photo, $folder)
    {
        $file_extension = $photo->getClientOriginalExtension();

        $File_name = time() . '.' . $file_extension;

        $path = $folder;
        $photo->move($path, $File_name);

        return $File_name;
    }
}
