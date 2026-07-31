<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $table = 'arm_estimates';
    protected $fillable = ['job_card_id', 'estimate_date', 'status'];
    protected function casts(): array { return [
            'estimate_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'job_card_id' => ['required', 'integer'],
            'estimate_date' => ['required', 'date'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'job_card_id', 'estimate_date', 'status']; }

    public function jobCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\JobCard::class, 'job_card_id'); }

}