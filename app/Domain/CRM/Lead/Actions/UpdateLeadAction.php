<?php

namespace App\Domain\CRM\Lead\Actions;

use App\Models\CRM\Lead;
use App\Domain\CRM\Lead\DTOs\LeadDTO;
use App\Models\AuditTrail;

class UpdateLeadAction
{
    public function execute(Lead $model, LeadDTO $dto): Lead
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Leads');
        $model->save();
        return $model->fresh();
    }
}