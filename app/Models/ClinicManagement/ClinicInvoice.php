<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicInvoice extends Model
{
    use HasFactory;
    protected $table = 'cm_clinic_invoices';
    protected $fillable = ['visit_id', 'amount', 'status'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'visit_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['paid', 'pending'])],
        ]; }
    public static function sortable(): array { return ['id', 'visit_id', 'amount', 'status']; }

    public function visit(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Visit::class, 'visit_id'); }

}