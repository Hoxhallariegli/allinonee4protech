<?php

namespace App\Domain\Berber\Barber\Actions;

use App\Models\Berber\Barber;
use App\Domain\Berber\Barber\DTOs\BarberDTO;
use App\Models\AuditTrail;

class CreateBarberAction
{
    public function execute(BarberDTO $dto): Barber
    {
        $item = Barber::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Barbers');
        return $item;
    }
}
