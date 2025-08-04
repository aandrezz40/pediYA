<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'logo_path',
        'description',
        'address_street',
        'address_neighborhood',
        'schedule',
        'offers_delivery',
        'delivery_contact_phone',
        'runt_number',
        'chamber_of_commerce_registration',
        'is_open',
        'status',
        'is_active'
    ];
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
        return $this->hasMany(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'store_payment_method');
    }
}
