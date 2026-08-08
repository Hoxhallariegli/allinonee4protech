<?php

namespace App\Models\FacilityManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;
    protected $table = 'facility_maintenance_requests';
    protected $fillable = ['building_id', 'technician_id', 'description', 'status'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'building_id' => ['required', 'integer'],
            'technician_id' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'in_progress', 'completed'])],
        ]; }
    public static function sortable(): array { return ['id', 'building_id', 'technician_id', 'description', 'status']; }

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FacilityManagement\Building::class, 'building_id'); }

    public function technician(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FacilityManagement\Technician::class, 'technician_id'); }

}