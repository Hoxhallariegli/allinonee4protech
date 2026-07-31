<?php

namespace App\Domain\AutoRepairManagement\JobCardPart\Actions;

use App\Models\AutoRepairManagement\JobCardPart;
use App\Domain\AutoRepairManagement\JobCardPart\DTOs\JobCardPartDTO;
use App\Models\AuditTrail;

class UpdateJobCardPartAction
{
    public function execute(JobCardPart $model, JobCardPartDTO $dto): JobCardPart
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'JobCardParts');
        $model->save();
        return $model->fresh();
    }
}