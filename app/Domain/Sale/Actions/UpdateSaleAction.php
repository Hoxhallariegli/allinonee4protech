<?php

namespace App\Domain\Sale\Actions;

use App\Models\Sale;
use App\Domain\Sale\DTOs\SaleDTO;

class UpdateSaleAction
{
    public function execute(Sale $model, SaleDTO $dto): bool { return $model->update($dto->toArray()); }
}