<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'arm_payments';
    protected $fillable = ['job_card_id', 'amount', 'status'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'job_card_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'job_card_id', 'amount', 'status']; }

    public function jobCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\JobCard::class, 'job_card_id'); }

}