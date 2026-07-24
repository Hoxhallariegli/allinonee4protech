<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;
use App\Domain\Product\DTOs\ProductDTO;

class UpdateProductAction
{
    public function execute(Product $model, ProductDTO $dto): bool { return $model->update($dto->toArray()); }
}