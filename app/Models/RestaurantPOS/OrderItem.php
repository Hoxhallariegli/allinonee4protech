<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'rp_order_items';
    protected $fillable = ['order_id', 'menu_item_id', 'quantity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'order_id' => ['required', 'integer'],
            'menu_item_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'order_id', 'menu_item_id', 'quantity']; }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\Order::class, 'order_id'); }

    public function menuItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\MenuItem::class, 'menu_item_id'); }

}