<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class PasswordComplexity implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            strlen($value) < 8 ||
            !preg_match('/[A-Z]/', $value) ||         // al menos una mayúscula
            !preg_match('/[0-9]/', $value) ||         // al menos un número
            !preg_match('/[\W]/', $value)             // al menos un carácter especial
        ) {
            $fail('La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.');
        }
    }
}
