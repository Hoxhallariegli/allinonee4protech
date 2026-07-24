<?php

namespace App\Domain\Sale\Actions;

use App\Models\Sale;
use App\Domain\Sale\DTOs\SaleDTO;

class CreateSaleAction
{
    public function execute(SaleDTO $dto): Sale { return Sale::create($dto->toArray()); }
}