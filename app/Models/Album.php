<?php

namespace App\Models;

use App\Scopes\UserAlbumScope;
use App\Traits\GenerateUuidTrait;
use App\Traits\UserCreateAlbumTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory,GenerateUuidTrait,UserCreateAlbumTrait;

    protected $fillable =['name'];

    public function pictures():hasMany
    {
        return  $this->hasMany(Picture::class)->latest();
    }

    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted(){
        static::addGlobalScope(new UserAlbumScope);

    }
}
