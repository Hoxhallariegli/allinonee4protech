<?php

namespace App\Domain\RestaurantPOS\DiningTable\Actions;

use App\Models\RestaurantPOS\DiningTable;
use App\Models\AuditTrail;

class DeleteDiningTableAction
{
    public function execute(DiningTable $model): bool 
    {
        AuditTrail::log($model, 'delete', 'DiningTables');
        return $model->delete(); 
    }
}