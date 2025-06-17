<?php

use App\Models\Product;
use App\Models\Category;

it('verifies a product belongs to a category', function () {
    // aqui se crea una categoría
    $category = Category::factory()->create([
        'name' => 'Bebidas',
    ]);

    // aqui se crea un producto y despues se asocia a la categoría
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    // despues se verifica que la relación devuelva una instancia de Category
    expect($product->category)->toBeInstanceOf(Category::class);

    // y a final seerifica que la categoría sea correcta
    expect($product->category->id)->toBe($category->id);
    expect($product->category->name)->toBe('Bebidas');
});
