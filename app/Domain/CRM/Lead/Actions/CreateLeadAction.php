<?php

namespace App\Domain\CRM\Lead\Actions;

use App\Models\CRM\Lead;
use App\Domain\CRM\Lead\DTOs\LeadDTO;
use App\Models\AuditTrail;

class CreateLeadAction
{
    public function execute(LeadDTO $dto): Lead 
    {
        $item = Lead::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Leads');
        return $item;
    }
}