<?php

namespace App\Models\EventManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;
    protected $table = 'event_ticket_types';
    protected $fillable = ['event_id', 'name', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'event_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'event_id', 'name', 'price']; }

    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\EventManagement\Event::class, 'event_id'); }

}