<?php

namespace App\Domain\AgricultureManagement\Field\Actions;

use App\Models\AgricultureManagement\Field;
use App\Domain\AgricultureManagement\Field\DTOs\FieldDTO;
use App\Models\AuditTrail;

class CreateFieldAction
{
    public function execute(FieldDTO $dto): Field 
    {
        $item = Field::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Fields');
        return $item;
    }
}