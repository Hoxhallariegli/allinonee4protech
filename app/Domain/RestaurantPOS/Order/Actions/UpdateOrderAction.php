<?php

namespace App\Domain\RestaurantPOS\Order\Actions;

use App\Models\RestaurantPOS\Order;
use App\Domain\RestaurantPOS\Order\DTOs\OrderDTO;
use App\Models\AuditTrail;

class UpdateOrderAction
{
    public function execute(Order $model, OrderDTO $dto): Order
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Orders');
        $model->save();
        return $model->fresh();
    }
}