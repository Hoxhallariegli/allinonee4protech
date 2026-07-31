<?php

namespace App\Domain\SchoolManagement\SchoolClass\Actions;

use App\Models\SchoolManagement\SchoolClass;
use App\Domain\SchoolManagement\SchoolClass\DTOs\SchoolClassDTO;
use App\Models\AuditTrail;

class CreateSchoolClassAction
{
    public function execute(SchoolClassDTO $dto): SchoolClass 
    {
        $item = SchoolClass::create($dto->toArray());
        AuditTrail::log($item, 'create', 'SchoolClasses');
        return $item;
    }
}