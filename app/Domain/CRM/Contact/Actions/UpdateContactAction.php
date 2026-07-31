<?php

namespace App\Domain\CRM\Contact\Actions;

use App\Models\CRM\Contact;
use App\Domain\CRM\Contact\DTOs\ContactDTO;
use App\Models\AuditTrail;

class UpdateContactAction
{
    public function execute(Contact $model, ContactDTO $dto): Contact
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Contacts');
        $model->save();
        return $model->fresh();
    }
}