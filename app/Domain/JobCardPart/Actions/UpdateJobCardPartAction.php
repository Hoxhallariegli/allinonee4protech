<?php

namespace App\Domain\JobCardPart\Actions;

use App\Models\JobCardPart;
use App\Domain\JobCardPart\DTOs\JobCardPartDTO;
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