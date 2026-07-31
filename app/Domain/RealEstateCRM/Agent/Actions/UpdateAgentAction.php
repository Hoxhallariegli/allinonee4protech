<?php

namespace App\Domain\RealEstateCRM\Agent\Actions;

use App\Models\RealEstateCRM\Agent;
use App\Domain\RealEstateCRM\Agent\DTOs\AgentDTO;
use App\Models\AuditTrail;

class UpdateAgentAction
{
    public function execute(Agent $model, AgentDTO $dto): Agent
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Agents');
        $model->save();
        return $model->fresh();
    }
}