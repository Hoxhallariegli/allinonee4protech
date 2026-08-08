<?php

namespace App\Models\FleetManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'fl_shipments';
    protected $fillable = ['vehicle_id', 'driver_id', 'origin', 'destination', 'status'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'driver_id' => ['required', 'integer'],
            'origin' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'driver_id', 'origin', 'destination', 'status']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FleetManagement\Vehicle::class, 'vehicle_id'); }

    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FleetManagement\Driver::class, 'driver_id'); }

}