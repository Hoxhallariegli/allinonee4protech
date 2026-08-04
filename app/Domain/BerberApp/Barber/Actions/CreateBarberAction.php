<?php

namespace App\Domain\BerberApp\Barber\Actions;

use App\Models\BerberApp\Barber;
use App\Domain\BerberApp\Barber\DTOs\BarberDTO;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Storage;

class CreateBarberAction
{
    public function execute(BarberDTO $dto): Barber
    {
        $data = $dto->toArray();

        if (isset($data['photo']) && is_object($data['photo'])) {
            $data['photo'] = $data['photo']->store('barbers', 'uploads');
        }

        $item = Barber::create($data);
        AuditTrail::log($item, 'create', 'Barbers');
        return $item;
    }
}
