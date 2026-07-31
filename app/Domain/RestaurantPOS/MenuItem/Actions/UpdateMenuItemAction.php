<?php

namespace App\Domain\RestaurantPOS\MenuItem\Actions;

use App\Models\RestaurantPOS\MenuItem;
use App\Domain\RestaurantPOS\MenuItem\DTOs\MenuItemDTO;
use App\Models\AuditTrail;

class UpdateMenuItemAction
{
    public function execute(MenuItem $model, MenuItemDTO $dto): MenuItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'MenuItems');
        $model->save();
        return $model->fresh();
    }
}