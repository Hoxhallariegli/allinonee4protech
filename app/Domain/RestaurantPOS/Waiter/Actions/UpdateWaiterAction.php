<?php

namespace App\Domain\RestaurantPOS\Waiter\Actions;

use App\Models\RestaurantPOS\Waiter;
use App\Domain\RestaurantPOS\Waiter\DTOs\WaiterDTO;
use App\Models\AuditTrail;

class UpdateWaiterAction
{
    public function execute(Waiter $model, WaiterDTO $dto): Waiter
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Waiters');
        $model->save();
        return $model->fresh();
    }
}