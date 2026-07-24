<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;

class DeleteProductAction
{
    public function execute(Product $model): bool { return $model->delete(); }
}