<?php

namespace App\Domain\Berber\Barber\Actions;

use App\Models\Berber\Barber;
use App\Domain\Berber\Barber\DTOs\BarberDTO;
use App\Models\AuditTrail;

class UpdateBarberAction
{
    public function execute(Barber $model, BarberDTO $dto): Barber
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Barbers');
        $model->save();
        return $model->fresh();
    }
}
