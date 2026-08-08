<?php

namespace App\Domain\ECommerce\Order\Actions;

use App\Models\ECommerce\Order;
use App\Domain\ECommerce\Order\DTOs\OrderDTO;
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