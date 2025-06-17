<?php

use App\Models\User;

test('isAdmin returns true if user role is admin', function () {
    $user = new User(['role' => 'admin']);
    expect($user->isAdmin())->toBeTrue();
});

test('isAdmin returns false if user role is not admin', function () {
    $user = new User(['role' => 'client']);
    expect($user->isAdmin())->toBeFalse();
});
