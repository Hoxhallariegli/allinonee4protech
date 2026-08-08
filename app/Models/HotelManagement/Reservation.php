<?php

namespace App\Models\HotelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'hm_reservations';
    protected $fillable = ['guest_id', 'room_id', 'check_in', 'check_out', 'total_price'];
    protected function casts(): array { return [
            'check_in' => 'datetime',
            'check_out' => 'datetime',
            'total_price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'guest_id' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date'],
            'total_price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'guest_id', 'room_id', 'check_in', 'check_out', 'total_price']; }

    public function guest(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HotelManagement\Guest::class, 'guest_id'); }

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HotelManagement\HotelRoom::class, 'room_id'); }

}