<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'name', 
        'description',
        'price',
        'category_id',
        'stock',
        'is_available',
        'image_path'
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];
    
    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function sortProductsByPrice(Collection $products): Collection
    {
        return $products->sortBy('price')->values();
    }

    /**
     * Obtener la URL de la imagen del producto
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('img/apple-2788616_640.jpg');
    }
}
