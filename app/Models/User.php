<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación con Address (un usuario tiene muchas direcciones)
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function defaultAddress()
    {
        return $this->hasOne(Address::class)->where('is_default', true);
    }

    /**
     * Relación con tiendas favoritas (muchos a muchos)
     */
    public function favoriteStores()
    {
        return $this->belongsToMany(Store::class, 'store_favorites')->withTimestamps();
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
