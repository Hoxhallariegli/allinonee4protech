<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_id', 'appointment_date', 'status', 'notes'];
    protected function casts(): array { return [
            'appointment_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'appointment_date' => ['required', 'date'],
            'status' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'appointment_date', 'status', 'notes']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Vehicle::class, 'vehicle_id'); }

}