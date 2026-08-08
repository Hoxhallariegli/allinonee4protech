<?php

namespace App\Domain\ECommerce\OrderItem\Actions;

use App\Models\ECommerce\OrderItem;
use App\Domain\ECommerce\OrderItem\DTOs\OrderItemDTO;
use App\Models\AuditTrail;

class CreateOrderItemAction
{
    public function execute(OrderItemDTO $dto): OrderItem 
    {
        $item = OrderItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'OrderItems');
        return $item;
    }
}