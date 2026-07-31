<?php

namespace App\Domain\AutoRepairManagement\Invoice\Actions;

use App\Models\AutoRepairManagement\Invoice;
use App\Domain\AutoRepairManagement\Invoice\DTOs\InvoiceDTO;
use App\Models\AuditTrail;

class CreateInvoiceAction
{
    public function execute(InvoiceDTO $dto): Invoice 
    {
        $item = Invoice::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Invoices');
        return $item;
    }
}