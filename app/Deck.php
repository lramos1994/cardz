<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'cards'
    ];

    public function getCardsAttribute($value)
    {
        return $this->cards()->get();
    }

    /**
     * Get the user record associated with the user.
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * The games that belong to the deck.
     */
    public function games()
    {
        return $this->belongsToMany('App\Game')->withTimestamps();;
    }

    /**
     * The cards that belong to the deck.
     */
    public function cards()
    {
        return $this->belongsToMany('App\Card')->withTimestamps();;
    }
}
