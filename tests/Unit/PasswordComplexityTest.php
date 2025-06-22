<?php
//./vendor/bin/pest --filter=PasswordComplexityTest
use App\Rules\PasswordComplexity;

beforeEach(function () {
    $this->rule = new PasswordComplexity();
});

test('valid passwords pass the complexity rule', function () {
    $validPasswords = [
        'Abcdef1!',
        'StrongPass123$',
        'Valid#Pass9',
        'Test@2025',
        'Secure!A2',
    ];

    foreach ($validPasswords as $password) {
        $called = false;

        $this->rule->validate('password', $password, function ($message) use (&$called) {
            $called = true;
        });

        expect($called)->toBeFalse(); 
    }
});

test('invalid passwords fail the complexity rule', function () {
    $invalidPasswords = [
        'abcdefg',      
        'ABCDEFGH',     
        '12345678',     
        'Abcdefgh',     
        'abc12345', 
        'ABC12345',          
        'Abcdefg1',     
        'A1!',          
    ];

    foreach ($invalidPasswords as $password) {
        $called = false;

        $this->rule->validate('password', $password, function ($message) use (&$called) {
            $called = true;
            expect($message)->toBe('La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.');
        });

        expect($called)->toBeTrue(); // Debe llamar a $fail, así que $called debe ser true
    }
});
