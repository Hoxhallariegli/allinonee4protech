<?php

namespace App\Domain\CRM\Interaction\Actions;

use App\Models\CRM\Interaction;
use App\Domain\CRM\Interaction\DTOs\InteractionDTO;
use App\Models\AuditTrail;

class CreateInteractionAction
{
    public function execute(InteractionDTO $dto): Interaction 
    {
        $item = Interaction::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Interactions');
        return $item;
    }
}