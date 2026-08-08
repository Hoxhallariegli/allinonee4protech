<?php

namespace App\Domain\TravelAgency\TourPackage\Actions;

use App\Models\TravelAgency\TourPackage;
use App\Domain\TravelAgency\TourPackage\DTOs\TourPackageDTO;
use App\Models\AuditTrail;

class CreateTourPackageAction
{
    public function execute(TourPackageDTO $dto): TourPackage 
    {
        $item = TourPackage::create($dto->toArray());
        AuditTrail::log($item, 'create', 'TourPackages');
        return $item;
    }
}