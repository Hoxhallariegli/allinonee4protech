<?php

namespace App\Domain\ECommerce\OrderItem\Actions;

use App\Models\ECommerce\OrderItem;
use App\Models\AuditTrail;

class DeleteOrderItemAction
{
    public function execute(OrderItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'OrderItems');
        return $model->delete(); 
    }
}