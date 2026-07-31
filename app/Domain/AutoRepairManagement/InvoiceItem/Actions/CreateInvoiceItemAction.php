<?php

namespace App\Domain\AutoRepairManagement\InvoiceItem\Actions;

use App\Models\AutoRepairManagement\InvoiceItem;
use App\Domain\AutoRepairManagement\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Models\AuditTrail;

class CreateInvoiceItemAction
{
    public function execute(InvoiceItemDTO $dto): InvoiceItem 
    {
        $item = InvoiceItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'InvoiceItems');
        return $item;
    }
}