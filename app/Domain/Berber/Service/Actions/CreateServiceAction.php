<?php

namespace App\Domain\Berber\Service\Actions;

use App\Models\Berber\Service;
use App\Domain\Berber\Service\DTOs\ServiceDTO;
use App\Models\AuditTrail;

class CreateServiceAction
{
    public function execute(ServiceDTO $dto): Service
    {
        $item = Service::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Services');
        return $item;
    }
}
