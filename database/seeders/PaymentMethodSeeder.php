<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['id' => 1, 'name' => 'Efectivo'],
            ['id' => 2, 'name' => 'Transferencia bancaria'],
            ['id' => 3, 'name' => 'Nequi'],
            ['id' => 4, 'name' => 'PSE'],
            ['id' => 5, 'name' => 'Tarjeta de Crédito'],
            ['id' => 6, 'name' => 'Tarjeta de Débito'],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::updateOrCreate(
                ['id' => $method['id']],
                ['name' => $method['name']]
            );
        }
    }
} 