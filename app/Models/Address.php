<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',
        'address_line_1',
        'neighborhood',
        'is_default',
    ];

    /**
     * Relación inversa con User (una dirección pertenece a un usuario)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
