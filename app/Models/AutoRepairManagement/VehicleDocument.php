<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDocument extends Model
{
    use HasFactory;
    protected $table = 'arm_vehicle_documents';
    protected $fillable = ['type', 'document', 'vehicle_id'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'type' => ['required', 'string', 'max:255'],
            'document' => ['required', 'max:255'],
            'vehicle_id' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'type', 'document', 'vehicle_id']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Vehicle::class, 'vehicle_id'); }

}