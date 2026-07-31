<?php

namespace App\Domain\AutoRepairManagement\InvoiceItem\Actions;

use App\Models\AutoRepairManagement\InvoiceItem;
use App\Domain\AutoRepairManagement\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Models\AuditTrail;

class UpdateInvoiceItemAction
{
    public function execute(InvoiceItem $model, InvoiceItemDTO $dto): InvoiceItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'InvoiceItems');
        $model->save();
        return $model->fresh();
    }
}