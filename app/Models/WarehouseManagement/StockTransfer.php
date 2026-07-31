<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;
    protected $table = 'wm_stock_transfers';
    protected $fillable = ['product_id', 'from_warehouse_id', 'to_warehouse_id', 'quantity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'product_id' => ['required', 'integer'],
            'from_warehouse_id' => ['required', 'integer'],
            'to_warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'product_id', 'from_warehouse_id', 'to_warehouse_id', 'quantity']; }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Product::class, 'product_id'); }

    public function fromWarehouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Warehouse::class, 'from_warehouse_id'); }

    public function toWarehouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Warehouse::class, 'to_warehouse_id'); }

}