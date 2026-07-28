<?php

namespace App\Domain\JobCardPart\Actions;

use App\Models\JobCardPart;
use App\Domain\JobCardPart\DTOs\JobCardPartDTO;
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