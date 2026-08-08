<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'cm_payments';
    protected $fillable = ['patient_id', 'invoice_id', 'amount', 'payment_method'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'patient_id' => ['required', 'integer'],
            'invoice_id' => ['nullable', 'integer'],
            'amount' => ['required', 'numeric'],
            'payment_method' => ['required', \Illuminate\Validation\Rule::in(['cash', 'card', 'insurance'])],
        ]; }
    public static function sortable(): array { return ['id', 'patient_id', 'invoice_id', 'amount', 'payment_method']; }

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Patient::class, 'patient_id'); }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\ClinicInvoice::class, 'invoice_id'); }

}