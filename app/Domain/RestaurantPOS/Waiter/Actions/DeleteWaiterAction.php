<?php

namespace App\Domain\RestaurantPOS\Waiter\Actions;

use App\Models\RestaurantPOS\Waiter;
use App\Models\AuditTrail;

class DeleteWaiterAction
{
    public function execute(Waiter $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Waiters');
        return $model->delete(); 
    }
}