<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'wm_purchase_orders';
    protected $fillable = ['supplier_id', 'order_date', 'status'];
    protected function casts(): array { return [
            'order_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'supplier_id' => ['required', 'integer'],
            'order_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'received', 'cancelled'])],
        ]; }
    public static function sortable(): array { return ['id', 'supplier_id', 'order_date', 'status']; }

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Supplier::class, 'supplier_id'); }

}