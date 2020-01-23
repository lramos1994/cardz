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
        'name'
    ];

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
}
