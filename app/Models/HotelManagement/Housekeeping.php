<?php

namespace App\Models\HotelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housekeeping extends Model
{
    use HasFactory;
    protected $table = 'hm_housekeepings';
    protected $fillable = ['room_id', 'task', 'is_completed'];
    protected function casts(): array { return [
            'is_completed' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'room_id' => ['required', 'integer'],
            'task' => ['required', 'string'],
            'is_completed' => ['nullable', 'boolean'],
        ]; }
    public static function sortable(): array { return ['id', 'room_id', 'task', 'is_completed']; }

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HotelManagement\HotelRoom::class, 'room_id'); }

}