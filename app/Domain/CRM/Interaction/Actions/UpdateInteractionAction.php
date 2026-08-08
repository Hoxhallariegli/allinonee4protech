<?php

namespace App\Domain\CRM\Interaction\Actions;

use App\Models\CRM\Interaction;
use App\Domain\CRM\Interaction\DTOs\InteractionDTO;
use App\Models\AuditTrail;

class UpdateInteractionAction
{
    public function execute(Interaction $model, InteractionDTO $dto): Interaction
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Interactions');
        $model->save();
        return $model->fresh();
    }
}