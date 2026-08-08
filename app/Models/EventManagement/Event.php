<?php

namespace App\Models\EventManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event_events';
    protected $fillable = ['title', 'organizer_id', 'event_date', 'location'];
    protected function casts(): array { return [
            'event_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'organizer_id' => ['required', 'integer'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'organizer_id', 'event_date', 'location']; }

    public function organizer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\EventManagement\Organizer::class, 'organizer_id'); }

}