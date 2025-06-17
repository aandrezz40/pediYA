<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Product extends Model
{
    protected $fillable = ['name', 'price'];
    
    public function store(){
        return $this->belongTo(Store::class, 'store_id');
    }
        public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function sortProductsByPrice(Collection $products): Collection
    {
        return $products->sortBy('price')->values();
    }
}
