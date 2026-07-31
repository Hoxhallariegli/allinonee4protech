<?php

namespace App\Domain\RealEstateCRM\Agent\Actions;

use App\Models\RealEstateCRM\Agent;
use App\Models\AuditTrail;

class DeleteAgentAction
{
    public function execute(Agent $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Agents');
        return $model->delete(); 
    }
}