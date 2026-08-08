<?php

namespace App\Domain\GymManagement\Trainer\Actions;

use App\Models\GymManagement\Trainer;
use App\Domain\GymManagement\Trainer\DTOs\TrainerDTO;
use App\Models\AuditTrail;

class UpdateTrainerAction
{
    public function execute(Trainer $model, TrainerDTO $dto): Trainer
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Trainers');
        $model->save();
        return $model->fresh();
    }
}