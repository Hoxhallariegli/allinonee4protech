<?php

namespace App\Models\ECommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'ecom_order_items';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'order_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'order_id', 'product_id', 'quantity', 'price']; }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ECommerce\Order::class, 'order_id'); }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ECommerce\Product::class, 'product_id'); }

}