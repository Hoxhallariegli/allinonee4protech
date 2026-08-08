<?php

namespace App\Domain\GymManagement\Trainer\Actions;

use App\Models\GymManagement\Trainer;
use App\Models\AuditTrail;

class DeleteTrainerAction
{
    public function execute(Trainer $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Trainers');
        return $model->delete(); 
    }
}