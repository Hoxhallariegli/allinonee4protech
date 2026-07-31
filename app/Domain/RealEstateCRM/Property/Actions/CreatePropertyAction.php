<?php

namespace App\Domain\RealEstateCRM\Property\Actions;

use App\Models\RealEstateCRM\Property;
use App\Domain\RealEstateCRM\Property\DTOs\PropertyDTO;
use App\Models\AuditTrail;

class CreatePropertyAction
{
    public function execute(PropertyDTO $dto): Property 
    {
        $item = Property::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Properties');
        return $item;
    }
}