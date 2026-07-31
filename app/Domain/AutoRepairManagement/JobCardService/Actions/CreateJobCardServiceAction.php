<?php

namespace App\Domain\AutoRepairManagement\JobCardService\Actions;

use App\Models\AutoRepairManagement\JobCardService;
use App\Domain\AutoRepairManagement\JobCardService\DTOs\JobCardServiceDTO;
use App\Models\AuditTrail;

class CreateJobCardServiceAction
{
    public function execute(JobCardServiceDTO $dto): JobCardService 
    {
        $item = JobCardService::create($dto->toArray());
        AuditTrail::log($item, 'create', 'JobCardServices');
        return $item;
    }
}