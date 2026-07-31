<?php

namespace App\Domain\ClinicManagement\ClinicInvoice\Actions;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Domain\ClinicManagement\ClinicInvoice\DTOs\ClinicInvoiceDTO;
use App\Models\AuditTrail;

class CreateClinicInvoiceAction
{
    public function execute(ClinicInvoiceDTO $dto): ClinicInvoice 
    {
        $item = ClinicInvoice::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ClinicInvoices');
        return $item;
    }
}