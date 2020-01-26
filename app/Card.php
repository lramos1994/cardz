<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'attack', 'life', 'defense', 'user_id'
    ];

    protected $hidden = [
        'pivot'
    ];

    /**
     * Get the decks.
     */
    public function decks()
    {
        return $this->belongsToMany('App\Deck')->withTimestamps();;
    }
}
