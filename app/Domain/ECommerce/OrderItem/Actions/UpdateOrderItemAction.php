<?php

namespace App\Domain\ECommerce\OrderItem\Actions;

use App\Models\ECommerce\OrderItem;
use App\Domain\ECommerce\OrderItem\DTOs\OrderItemDTO;
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