<?php

namespace App\Domain\CRM\Company\Actions;

use App\Models\CRM\Company;
use App\Domain\CRM\Company\DTOs\CompanyDTO;
use App\Models\AuditTrail;

class UpdateCompanyAction
{
    public function execute(Company $model, CompanyDTO $dto): Company
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Companies');
        $model->save();
        return $model->fresh();
    }
}