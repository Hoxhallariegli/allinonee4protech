<?php

namespace App\Models\Berber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'b_reminders';

    protected $fillable = ['booking_id', 'send_at', 'sent_at', 'type', 'status'];

    protected function casts(): array {
        return [
            'send_at' => 'datetime',
            'sent_at' => 'datetime',
        ];
    }

    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
