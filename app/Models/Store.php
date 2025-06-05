<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function favoritedByUsers(){
    
        return $this->belongsToMany(User::class, 'store_favorites')->withTimestamps();
    
    }

    public function user(){
    
        return $this->belongsTo(User::class, 'user_id');
    
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->hasMany(category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }



    
    
}
