<?php
    //./vendor/bin/pest --filter=UserPasswordValidationTest
use App\Models\User;
use App\Rules\PasswordComplexity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user model fails validation when password is too weak', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'weakpass', 
    ];

    $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', new PasswordComplexity()],
    ];

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('password'))->toBeTrue();
});

test('user model passes validation with a strong password', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'Str0ng!Pass123', 
    ];

    $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', new PasswordComplexity()],
    ];

    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeTrue();
});
