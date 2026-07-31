<?php

namespace App\Domain\RealEstateCRM\Agent\Actions;

use App\Models\RealEstateCRM\Agent;
use App\Domain\RealEstateCRM\Agent\DTOs\AgentDTO;
use App\Models\AuditTrail;

class CreateAgentAction
{
    public function execute(AgentDTO $dto): Agent 
    {
        $item = Agent::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Agents');
        return $item;
    }
}