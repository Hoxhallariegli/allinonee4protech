<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'ba_bookings';
    protected $fillable = ['barber_id', 'service_id', 'customer_name', 'customer_phone', 'appointment_datetime', 'status', 'reminder_enabled', 'reminder_minutes', 'cancel_reason'];
    protected function casts(): array { return [
            'appointment_datetime' => 'datetime',
            'reminder_enabled' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'barber_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:255'],
            'appointment_datetime' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'confirmed', 'cancelled', 'completed'])],
            'reminder_enabled' => ['required', 'boolean'],
            'reminder_minutes' => ['required', 'integer'],
            'cancel_reason' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'barber_id', 'service_id', 'customer_name', 'customer_phone', 'appointment_datetime', 'status', 'reminder_enabled', 'reminder_minutes', 'cancel_reason']; }

    public function barber(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\BerberApp\Barber::class, 'barber_id'); }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\BerberApp\Service::class, 'service_id'); }

}
