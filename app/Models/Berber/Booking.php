<?php

namespace App\Models\Berber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'b_bookings';

    protected $fillable = [
        'barber_id', 'service_id', 'customer_name', 'customer_phone',
        'appointment_datetime', 'status', 'reminder_enabled', 'reminder_minutes'
    ];

    protected function casts(): array {
        return [
            'appointment_datetime' => 'datetime',
            'reminder_enabled' => 'boolean',
        ];
    }

    public static function rules($id = null): array {
        return [
            'barber_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'appointment_datetime' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'confirmed', 'cancelled', 'completed'])],
            'reminder_enabled' => ['required', 'boolean'],
            'reminder_minutes' => ['required', 'integer'],
        ];
    }

    public static function sortable(): array {
        return ['id', 'customer_name', 'appointment_datetime', 'status'];
    }

    public function barber() {
        return $this->belongsTo(Barber::class, 'barber_id');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
