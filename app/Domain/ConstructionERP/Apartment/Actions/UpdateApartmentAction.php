<?php

namespace App\Domain\ConstructionERP\Apartment\Actions;

use App\Models\ConstructionERP\Apartment;
use App\Domain\ConstructionERP\Apartment\DTOs\ApartmentDTO;
use App\Models\AuditTrail;

class UpdateApartmentAction
{
    public function execute(Apartment $model, ApartmentDTO $dto): Apartment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Apartments');
        $model->save();
        return $model->fresh();
    }
}