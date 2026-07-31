<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table = 'arm_vehicle_models';
    protected $fillable = ['name', 'brand_id'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'brand_id' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'brand_id']; }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\VehicleBrand::class, 'brand_id'); }

}