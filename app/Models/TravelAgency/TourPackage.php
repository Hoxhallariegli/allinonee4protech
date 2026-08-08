<?php

namespace App\Models\TravelAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    protected $table = 'travel_tour_packages';
    protected $fillable = ['name', 'destination_id', 'price', 'duration_days', 'photo'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'duration_days' => ['required', 'integer'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'destination_id', 'price', 'duration_days', 'photo']; }

    public function destination(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\TravelAgency\Destination::class, 'destination_id'); }

}