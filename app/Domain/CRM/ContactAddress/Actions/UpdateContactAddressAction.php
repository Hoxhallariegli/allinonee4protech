<?php

namespace App\Domain\CRM\ContactAddress\Actions;

use App\Models\CRM\ContactAddress;
use App\Domain\CRM\ContactAddress\DTOs\ContactAddressDTO;
use App\Models\AuditTrail;

class UpdateContactAddressAction
{
    public function execute(ContactAddress $model, ContactAddressDTO $dto): ContactAddress
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ContactAddresses');
        $model->save();
        return $model->fresh();
    }
}