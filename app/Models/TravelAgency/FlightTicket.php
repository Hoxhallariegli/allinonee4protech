<?php

namespace App\Models\TravelAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightTicket extends Model
{
    use HasFactory;
    protected $table = 'travel_flight_tickets';
    protected $fillable = ['client_id', 'flight_number', 'departure_date', 'price'];
    protected function casts(): array { return [
            'departure_date' => 'datetime',
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'client_id' => ['required', 'integer'],
            'flight_number' => ['required', 'string', 'max:255'],
            'departure_date' => ['required', 'date'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'client_id', 'flight_number', 'departure_date', 'price']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\TravelAgency\Client::class, 'client_id'); }

}