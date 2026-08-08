<?php

namespace App\Domain\ECommerce\Order\Actions;

use App\Models\ECommerce\Order;
use App\Models\AuditTrail;

class DeleteOrderAction
{
    public function execute(Order $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Orders');
        return $model->delete(); 
    }
}