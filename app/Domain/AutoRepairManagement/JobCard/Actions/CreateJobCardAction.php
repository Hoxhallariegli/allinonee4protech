<?php

namespace App\Domain\AutoRepairManagement\JobCard\Actions;

use App\Models\AutoRepairManagement\JobCard;
use App\Domain\AutoRepairManagement\JobCard\DTOs\JobCardDTO;
use App\Models\AuditTrail;

class CreateJobCardAction
{
    public function execute(JobCardDTO $dto): JobCard 
    {
        $item = JobCard::create($dto->toArray());
        AuditTrail::log($item, 'create', 'JobCards');
        return $item;
    }
}