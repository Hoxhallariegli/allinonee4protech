<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberWorkingHour extends Model
{
    use HasFactory;

    protected $table = 'ba_barber_working_hours';

    protected $fillable = [
        'barber_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_off',
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
