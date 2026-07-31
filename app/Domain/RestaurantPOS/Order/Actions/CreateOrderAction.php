<?php

namespace App\Domain\RestaurantPOS\Order\Actions;

use App\Models\RestaurantPOS\Order;
use App\Domain\RestaurantPOS\Order\DTOs\OrderDTO;
use App\Models\AuditTrail;

class CreateOrderAction
{
    public function execute(OrderDTO $dto): Order 
    {
        $item = Order::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Orders');
        return $item;
    }
}