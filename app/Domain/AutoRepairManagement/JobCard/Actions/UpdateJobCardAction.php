<?php

namespace App\Domain\AutoRepairManagement\JobCard\Actions;

use App\Models\AutoRepairManagement\JobCard;
use App\Domain\AutoRepairManagement\JobCard\DTOs\JobCardDTO;
use App\Models\AuditTrail;

class UpdateJobCardAction
{
    public function execute(JobCard $model, JobCardDTO $dto): JobCard
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'JobCards');
        $model->save();
        return $model->fresh();
    }
}