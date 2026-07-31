<?php

namespace App\Domain\RestaurantPOS\MenuItem\Actions;

use App\Models\RestaurantPOS\MenuItem;
use App\Domain\RestaurantPOS\MenuItem\DTOs\MenuItemDTO;
use App\Models\AuditTrail;

class CreateMenuItemAction
{
    public function execute(MenuItemDTO $dto): MenuItem 
    {
        $item = MenuItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'MenuItems');
        return $item;
    }
}