<?php

namespace App\Models\LegalManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'legal_billings';
    protected $fillable = ['case_id', 'amount', 'status'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'case_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['paid', 'unpaid'])],
        ]; }
    public static function sortable(): array { return ['id', 'case_id', 'amount', 'status']; }

    public function case(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\LegalManagement\LegalCase::class, 'case_id'); }

}