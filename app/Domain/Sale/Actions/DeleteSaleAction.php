<?php

namespace App\Domain\Sale\Actions;

use App\Models\Sale;

class DeleteSaleAction
{
    public function execute(Sale $model): bool { return $model->delete(); }
}