<?php

namespace App\Domain\BerberApp\Barber\Actions;

use App\Models\BerberApp\Barber;
use App\Domain\BerberApp\Barber\DTOs\BarberDTO;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Storage;

class UpdateBarberAction
{
    public function execute(Barber $model, BarberDTO $dto): Barber
    {
        $data = $dto->toArray();

        if (isset($data['photo']) && is_object($data['photo'])) {
            // Delete old photo if exists
            if ($model->photo) {
                Storage::disk('public')->delete($model->photo);
            }
            $data['photo'] = $data['photo']->store('barbers', 'public');
        }

        $model->fill($data);
        AuditTrail::log($model, 'update', 'Barbers');
        $model->save();
        return $model->fresh();
    }
}
