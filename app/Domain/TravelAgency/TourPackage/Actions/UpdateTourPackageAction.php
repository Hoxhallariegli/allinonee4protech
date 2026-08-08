<?php

namespace App\Domain\TravelAgency\TourPackage\Actions;

use App\Models\TravelAgency\TourPackage;
use App\Domain\TravelAgency\TourPackage\DTOs\TourPackageDTO;
use App\Models\AuditTrail;

class UpdateTourPackageAction
{
    public function execute(TourPackage $model, TourPackageDTO $dto): TourPackage
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'TourPackages');
        $model->save();
        return $model->fresh();
    }
}