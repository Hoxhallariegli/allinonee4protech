<?php

namespace App\Domain\RestaurantPOS\OrderItem\Actions;

use App\Models\RestaurantPOS\OrderItem;
use App\Models\AuditTrail;

class DeleteOrderItemAction
{
    public function execute(OrderItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'OrderItems');
        return $model->delete(); 
    }
}