<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_order_id', 'part_id', 'quantity', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'purchase_order_id' => ['required', 'integer'],
            'part_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'purchase_order_id', 'part_id', 'quantity', 'price']; }

    public function purchaseOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\PurchaseOrder::class, 'purchase_order_id'); }

    public function part(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Part::class, 'part_id'); }

}