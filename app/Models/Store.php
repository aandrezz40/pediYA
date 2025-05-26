<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
public function favoritedByUsers()
{
    return $this->belongsToMany(User::class, 'store_favorites')->withTimestamps();
}
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
