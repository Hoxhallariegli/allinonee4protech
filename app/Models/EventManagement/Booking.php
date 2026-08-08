<?php

namespace App\Models\EventManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'event_bookings';
    protected $fillable = ['event_id', 'attendee_id', 'status'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'event_id' => ['required', 'integer'],
            'attendee_id' => ['required', 'integer'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'confirmed', 'cancelled'])],
        ]; }
    public static function sortable(): array { return ['id', 'event_id', 'attendee_id', 'status']; }

    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\EventManagement\Event::class, 'event_id'); }

    public function attendee(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\EventManagement\Attendee::class, 'attendee_id'); }

}