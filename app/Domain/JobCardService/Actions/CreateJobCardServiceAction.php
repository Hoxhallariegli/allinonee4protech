<?php

namespace App\Domain\JobCardService\Actions;

use App\Models\JobCardService;
use App\Domain\JobCardService\DTOs\JobCardServiceDTO;
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