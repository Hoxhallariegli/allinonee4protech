<?php

namespace App\Domain\JobCardService\Actions;

use App\Models\JobCardService;
use App\Domain\JobCardService\DTOs\JobCardServiceDTO;
use App\Models\AuditTrail;

class UpdateJobCardServiceAction
{
    public function execute(JobCardService $model, JobCardServiceDTO $dto): JobCardService
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'JobCardServices');
        $model->save();
        return $model->fresh();
    }
}