<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUuidTrait
{
    public static function generate(){
        static::saving(function($model){
            $model->hashed_id = Str::uuid();
        });
    }
}
