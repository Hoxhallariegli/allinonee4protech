<?php

namespace App\Domain\AutoRepairManagement\JobCardPart\Actions;

use App\Models\AutoRepairManagement\JobCardPart;
use App\Domain\AutoRepairManagement\JobCardPart\DTOs\JobCardPartDTO;
use App\Models\AuditTrail;

class CreateJobCardPartAction
{
    public function execute(JobCardPartDTO $dto): JobCardPart 
    {
        $item = JobCardPart::create($dto->toArray());
        AuditTrail::log($item, 'create', 'JobCardParts');
        return $item;
    }
}