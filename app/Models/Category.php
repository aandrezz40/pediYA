<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function store(){
        return $this->belongTo(Store::class, 'store_id');
    }
}
