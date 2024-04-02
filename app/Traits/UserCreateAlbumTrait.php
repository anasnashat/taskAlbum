<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UserCreateAlbumTrait
{
    public static function currentUserCreateAlbum(){
        static::saving(function($model){
            $model->user_id = auth()->id();
        });
    }
}
