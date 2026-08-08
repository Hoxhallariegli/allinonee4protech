<?php

namespace App\Domain\TravelAgency\TourPackage\Actions;

use App\Models\TravelAgency\TourPackage;
use App\Models\AuditTrail;

class DeleteTourPackageAction
{
    public function execute(TourPackage $model): bool 
    {
        AuditTrail::log($model, 'delete', 'TourPackages');
        return $model->delete(); 
    }
}