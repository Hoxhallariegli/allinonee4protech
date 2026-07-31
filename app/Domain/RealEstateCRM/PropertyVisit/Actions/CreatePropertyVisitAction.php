<?php

namespace App\Domain\RealEstateCRM\PropertyVisit\Actions;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Domain\RealEstateCRM\PropertyVisit\DTOs\PropertyVisitDTO;
use App\Models\AuditTrail;

class CreatePropertyVisitAction
{
    public function execute(PropertyVisitDTO $dto): PropertyVisit 
    {
        $item = PropertyVisit::create($dto->toArray());
        AuditTrail::log($item, 'create', 'PropertyVisits');
        return $item;
    }
}