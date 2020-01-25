<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'attack',
        'life',
        'defense',
        'decks',
    ];

    protected $appends = [
        'decks'
    ];

    public function getDecksAttribute($value) {
        return $this->decks()->get();
    }

    /**
     * Get the user record associated with the user.
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Get the decks.
     */
    public function decks()
    {
        return $this->belongsToMany('App\Deck')->withTimestamps();;
    }


}
