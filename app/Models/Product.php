<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function store(){
        return $this->belongTo(Store::class, 'store_id');
    }
        public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
