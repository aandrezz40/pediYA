<?php
//./vendor/bin/pest --filter=ProductCategoryRelationTest


use App\Models\Product;
use App\Models\Category;

it('verifies a product belongs to a category (unit test)', function () {
    // Creamos una categoría manualmente (sin persistir)
    $category = new Category(['id' => 1, 'name' => 'Bebidas']);

    // Creamos un producto y le asociamos la categoría manualmente
    $product = new Product(['category_id' => 1]);
    $product->setRelation('category', $category); // Simulamos la relación

    // Verificaciones unitarias
    expect($product->category)->toBeInstanceOf(Category::class);
    expect($product->category->id)->toBe(1);
    expect($product->category->name)->toBe('Bebidas');
});

