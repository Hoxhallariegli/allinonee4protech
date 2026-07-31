<?php

namespace App\Domain\RestaurantPOS\Waiter\Actions;

use App\Models\RestaurantPOS\Waiter;
use App\Domain\RestaurantPOS\Waiter\DTOs\WaiterDTO;
use App\Models\AuditTrail;

class CreateWaiterAction
{
    public function execute(WaiterDTO $dto): Waiter 
    {
        $item = Waiter::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Waiters');
        return $item;
    }
}