<?php

namespace App\Domain\CRM\Contact\Actions;

use App\Models\CRM\Contact;
use App\Domain\CRM\Contact\DTOs\ContactDTO;
use App\Models\AuditTrail;

class CreateContactAction
{
    public function execute(ContactDTO $dto): Contact 
    {
        $item = Contact::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Contacts');
        return $item;
    }
}