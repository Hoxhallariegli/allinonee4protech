<?php

namespace App\Domain\RestaurantPOS\OrderItem\Actions;

use App\Models\RestaurantPOS\OrderItem;
use App\Domain\RestaurantPOS\OrderItem\DTOs\OrderItemDTO;
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