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

    /**
     * @var string[]
     * @JobOfTheFunc make us can add data into the database and make all hte cols in the array fillable
     */
    protected $fillable =['name'];

    /**
     * @return HasMany
     * @JobOfTheFunc this function defied the relationship  between the pictures and the album that make us
     *  can access the info of the pictures from the album in the relation
     */
    public function pictures():hasMany
    {
        return  $this->hasMany(Picture::class)->latest();
    }

    /**
     * @return BelongsTo
     * @JobOfTheFunc this function defied the relationship  between the user and the album that make us
     * can access the ifo of the user from the album in the relation
     */
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return void
     * this function will make all query gets with the condition of the global scope where user id = auth user id
     */
    protected static function booted(){
        static::addGlobalScope(new UserAlbumScope);

    }
}
