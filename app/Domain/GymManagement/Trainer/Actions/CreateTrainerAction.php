<?php

namespace App\Domain\GymManagement\Trainer\Actions;

use App\Models\GymManagement\Trainer;
use App\Domain\GymManagement\Trainer\DTOs\TrainerDTO;
use App\Models\AuditTrail;

class CreateTrainerAction
{
    public function execute(TrainerDTO $dto): Trainer 
    {
        $item = Trainer::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Trainers');
        return $item;
    }
}