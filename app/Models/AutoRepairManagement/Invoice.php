<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'arm_invoices';
    protected $fillable = ['job_card_id', 'invoice_date', 'total', 'status'];
    protected function casts(): array { return [
            'invoice_date' => 'datetime',
            'total' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'job_card_id' => ['required', 'integer'],
            'invoice_date' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'job_card_id', 'invoice_date', 'total', 'status']; }

    public function jobCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\JobCard::class, 'job_card_id'); }

}