<?php

namespace App\Domain\JobCard\Actions;

use App\Models\JobCard;
use App\Domain\JobCard\DTOs\JobCardDTO;
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