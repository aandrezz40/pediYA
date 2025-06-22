<?php
//./vendor/bin/pest --filter=UserCreationTest
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserCreationTest extends TestCase
{
    public function test_user_is_created_correctly_with_valid_data()
    {
        $user = new User([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@example.com',
            'phone_number' => '3101234567',
            'password' => bcrypt('Password123!'),
            'role' => 'cliente',
            'is_active' => true,
        ]);

        $this->assertEquals('Carlos Pérez', $user->name);
        $this->assertEquals('carlos@example.com', $user->email);
        $this->assertEquals('3101234567', $user->phone_number);
        $this->assertTrue(password_verify('Password123!', $user->password));
        $this->assertEquals('cliente', $user->role);
        $this->assertTrue($user->is_active);
    }
}
