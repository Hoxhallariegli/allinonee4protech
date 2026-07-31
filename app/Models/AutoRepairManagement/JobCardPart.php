<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardPart extends Model
{
    use HasFactory;
    protected $table = 'arm_job_card_parts';
    protected $fillable = ['job_card_id', 'part_id', 'quantity', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'job_card_id' => ['required', 'integer'],
            'part_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'job_card_id', 'part_id', 'quantity', 'price']; }

    public function jobCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\JobCard::class, 'job_card_id'); }

    public function part(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Part::class, 'part_id'); }

}