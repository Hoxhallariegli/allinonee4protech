<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'rp_orders';
    protected $fillable = ['table_id', 'waiter_id', 'order_date', 'status'];
    protected function casts(): array { return [
            'order_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'table_id' => ['required', 'integer'],
            'waiter_id' => ['required', 'integer'],
            'order_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'ready', 'paid'])],
        ]; }
    public static function sortable(): array { return ['id', 'table_id', 'waiter_id', 'order_date', 'status']; }

    public function table(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\DiningTable::class, 'table_id'); }

    public function waiter(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\Waiter::class, 'waiter_id'); }

}