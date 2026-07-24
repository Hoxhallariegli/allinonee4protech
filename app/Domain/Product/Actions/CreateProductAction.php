<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;
use App\Domain\Product\DTOs\ProductDTO;

class CreateProductAction
{
    public function execute(ProductDTO $dto): Product { return Product::create($dto->toArray()); }
}