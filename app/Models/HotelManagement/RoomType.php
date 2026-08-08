<?php

namespace App\Models\HotelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'hm_room_types';
    protected $fillable = ['name', 'base_price', 'photo'];
    protected function casts(): array { return [
            'base_price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'base_price' => ['required', 'numeric'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'base_price', 'photo']; }

}