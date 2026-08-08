<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;
    protected $table = 'wm_stock_adjustments';
    protected $fillable = ['product_id', 'warehouse_id', 'quantity', 'adjustment_type', 'reason'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'product_id' => ['required', 'integer'],
            'warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'adjustment_type' => ['required', \Illuminate\Validation\Rule::in(['addition', 'subtraction'])],
            'reason' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'product_id', 'warehouse_id', 'quantity', 'adjustment_type', 'reason']; }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Product::class, 'product_id'); }

    public function warehouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Warehouse::class, 'warehouse_id'); }

}