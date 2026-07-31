<?php

namespace App\Domain\SchoolManagement\SchoolClass\Actions;

use App\Models\SchoolManagement\SchoolClass;
use App\Domain\SchoolManagement\SchoolClass\DTOs\SchoolClassDTO;
use App\Models\AuditTrail;

class UpdateSchoolClassAction
{
    public function execute(SchoolClass $model, SchoolClassDTO $dto): SchoolClass
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'SchoolClasses');
        $model->save();
        return $model->fresh();
    }
}