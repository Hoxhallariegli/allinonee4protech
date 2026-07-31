<?php

namespace App\Domain\ConstructionERP\Apartment\Actions;

use App\Models\ConstructionERP\Apartment;
use App\Domain\ConstructionERP\Apartment\DTOs\ApartmentDTO;
use App\Models\AuditTrail;

class CreateApartmentAction
{
    public function execute(ApartmentDTO $dto): Apartment 
    {
        $item = Apartment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Apartments');
        return $item;
    }
}