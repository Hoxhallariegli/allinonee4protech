<?php

namespace App\Domain\CRM\ContactAddress\Actions;

use App\Models\CRM\ContactAddress;
use App\Domain\CRM\ContactAddress\DTOs\ContactAddressDTO;
use App\Models\AuditTrail;

class CreateContactAddressAction
{
    public function execute(ContactAddressDTO $dto): ContactAddress 
    {
        $item = ContactAddress::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ContactAddresses');
        return $item;
    }
}