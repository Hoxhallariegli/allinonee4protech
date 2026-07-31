<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $table = 'ba_reminders';
    protected $fillable = ['booking_id', 'send_at', 'sent_at', 'type', 'status'];
    protected function casts(): array { return [
            'send_at' => 'datetime',
            'sent_at' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'booking_id' => ['required', 'integer'],
            'send_at' => ['required', 'date'],
            'sent_at' => ['nullable', 'date'],
            'type' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'booking_id', 'send_at', 'sent_at', 'type', 'status']; }

    public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\BerberApp\Booking::class, 'booking_id'); }

}