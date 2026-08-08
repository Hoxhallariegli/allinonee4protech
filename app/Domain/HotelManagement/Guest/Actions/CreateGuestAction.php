<?php

namespace App\Domain\HotelManagement\Guest\Actions;

use App\Models\HotelManagement\Guest;
use App\Domain\HotelManagement\Guest\DTOs\GuestDTO;
use App\Models\AuditTrail;

class CreateGuestAction
{
    public function execute(GuestDTO $dto): Guest 
    {
        $item = Guest::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Guests');
        return $item;
    }
}