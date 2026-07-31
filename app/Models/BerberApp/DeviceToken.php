<?php

namespace App\Models\BerberApp;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $table = 'ba_device_tokens';

    protected $fillable = [
        'user_id',
        'booking_id',
        'fcm_token',
        'device_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
