<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $table = 'arm_invoice_items';
    protected $fillable = ['invoice_id', 'service_id', 'part_id', 'quantity', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'invoice_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'part_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'invoice_id', 'service_id', 'part_id', 'quantity', 'price']; }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Invoice::class, 'invoice_id'); }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Service::class, 'service_id'); }

    public function part(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Part::class, 'part_id'); }

}