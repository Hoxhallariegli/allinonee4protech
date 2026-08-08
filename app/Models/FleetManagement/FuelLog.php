<?php

namespace App\Models\FleetManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    use HasFactory;
    protected $table = 'fl_fuel_logs';
    protected $fillable = ['vehicle_id', 'date', 'amount', 'cost'];
    protected function casts(): array { return [
            'date' => 'datetime',
            'amount' => 'decimal:2',
            'cost' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'cost' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'date', 'amount', 'cost']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FleetManagement\Vehicle::class, 'vehicle_id'); }

}