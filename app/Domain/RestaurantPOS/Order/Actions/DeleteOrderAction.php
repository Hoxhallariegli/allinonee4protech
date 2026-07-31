<?php

namespace App\Domain\RestaurantPOS\Order\Actions;

use App\Models\RestaurantPOS\Order;
use App\Models\AuditTrail;

class DeleteOrderAction
{
    public function execute(Order $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Orders');
        return $model->delete(); 
    }
}