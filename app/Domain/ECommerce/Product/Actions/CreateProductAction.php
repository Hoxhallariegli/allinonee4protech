<?php

namespace App\Domain\ECommerce\Product\Actions;

use App\Models\ECommerce\Product;
use App\Domain\ECommerce\Product\DTOs\ProductDTO;
use App\Models\AuditTrail;

class CreateProductAction
{
    public function execute(ProductDTO $dto): Product 
    {
        $item = Product::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Products');
        return $item;
    }
}