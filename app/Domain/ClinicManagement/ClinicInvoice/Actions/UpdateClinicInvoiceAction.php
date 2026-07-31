<?php

namespace App\Domain\ClinicManagement\ClinicInvoice\Actions;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Domain\ClinicManagement\ClinicInvoice\DTOs\ClinicInvoiceDTO;
use App\Models\AuditTrail;

class UpdateClinicInvoiceAction
{
    public function execute(ClinicInvoice $model, ClinicInvoiceDTO $dto): ClinicInvoice
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ClinicInvoices');
        $model->save();
        return $model->fresh();
    }
}