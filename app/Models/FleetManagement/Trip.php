<?php

namespace App\Models\FleetManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'fl_trips';
    protected $fillable = ['vehicle_id', 'driver_id', 'start_location', 'destination', 'distance'];
    protected function casts(): array { return [
            'distance' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'driver_id' => ['required', 'integer'],
            'start_location' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'distance' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'driver_id', 'start_location', 'destination', 'distance']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FleetManagement\Vehicle::class, 'vehicle_id'); }

    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\FleetManagement\Driver::class, 'driver_id'); }

}