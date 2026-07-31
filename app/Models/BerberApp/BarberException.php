<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberException extends Model
{
    use HasFactory;

    protected $table = 'ba_barber_exceptions';

    protected $fillable = [
        'barber_id',
        'start_datetime',
        'end_datetime',
        'type',
        'reason',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
