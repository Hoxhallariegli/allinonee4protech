<?php

namespace App\Models\HotelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hm_hotel_rooms';
    protected $fillable = ['room_number', 'room_type_id', 'status', 'photo'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'room_number' => ['required', 'string', 'max:255'],
            'room_type_id' => ['required', 'integer'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['available', 'occupied', 'cleaning'])],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'room_number', 'room_type_id', 'status', 'photo']; }

    public function roomType(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HotelManagement\RoomType::class, 'room_type_id'); }

}