<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardService extends Model
{
    use HasFactory;
    protected $fillable = ['job_card_id', 'service_id', 'quantity', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'job_card_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'job_card_id', 'service_id', 'quantity', 'price']; }

    public function jobCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\JobCard::class, 'job_card_id'); }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Service::class, 'service_id'); }

}