<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $fillable = [
        'user_id',
        'store_id',
        'order_code',
        'total_amount',
        'status',
        'customer_notes',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products()
    {
    return $this->belongsToMany(Product::class)
                ->withPivot('product_name', 'unit_price', 'quantity', 'subtotal')
                ->withTimestamps();
    }
}







