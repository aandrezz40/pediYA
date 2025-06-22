<?php
//./vendor/bin/pest --filter=ProductPriceOrderTest
use App\Models\Product;
use Illuminate\Support\Collection;

it('orders products from cheapest to most expensive', function () {
    $productA = new Product(['name' => 'Producto A', 'price' => 100.00]);
    $productB = new Product(['name' => 'Producto B', 'price' => 50.00]);
    $productC = new Product(['name' => 'Producto C', 'price' => 75.00]);

    $products = collect([$productA, $productB, $productC]);

    $sorted = Product::sortProductsByPrice($products);

    expect($sorted->pluck('name')->all())->toBe(['Producto B', 'Producto C', 'Producto A']);
});
