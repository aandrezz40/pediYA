<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'store_id'];
    
    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
