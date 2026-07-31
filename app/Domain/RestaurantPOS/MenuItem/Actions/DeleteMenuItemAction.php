<?php

namespace App\Domain\RestaurantPOS\MenuItem\Actions;

use App\Models\RestaurantPOS\MenuItem;
use App\Models\AuditTrail;

class DeleteMenuItemAction
{
    public function execute(MenuItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'MenuItems');
        return $model->delete(); 
    }
}