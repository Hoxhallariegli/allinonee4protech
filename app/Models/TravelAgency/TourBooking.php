<?php

namespace App\Models\TravelAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    use HasFactory;
    protected $table = 'travel_tour_bookings';
    protected $fillable = ['client_id', 'tour_package_id', 'booking_date'];
    protected function casts(): array { return [
            'booking_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'client_id' => ['required', 'integer'],
            'tour_package_id' => ['required', 'integer'],
            'booking_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'client_id', 'tour_package_id', 'booking_date']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\TravelAgency\Client::class, 'client_id'); }

    public function tourPackage(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\TravelAgency\TourPackage::class, 'tour_package_id'); }

}