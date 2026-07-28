<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    use HasFactory;
    protected $fillable = ['estimate_id', 'service_id', 'part_id', 'quantity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'estimate_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'part_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'estimate_id', 'service_id', 'part_id', 'quantity']; }

    public function estimate(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Estimate::class, 'estimate_id'); }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Service::class, 'service_id'); }

    public function part(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Part::class, 'part_id'); }

}