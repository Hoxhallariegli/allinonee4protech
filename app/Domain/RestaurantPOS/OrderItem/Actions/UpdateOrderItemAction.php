<?php

namespace App\Domain\RestaurantPOS\OrderItem\Actions;

use App\Models\RestaurantPOS\OrderItem;
use App\Domain\RestaurantPOS\OrderItem\DTOs\OrderItemDTO;
use App\Models\AuditTrail;

class UpdateOrderItemAction
{
    public function execute(OrderItem $model, OrderItemDTO $dto): OrderItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'OrderItems');
        $model->save();
        return $model->fresh();
    }
}