<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'rp_payments';
    protected $fillable = ['order_id', 'amount', 'method'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'order_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'method' => ['required', \Illuminate\Validation\Rule::in(['cash', 'card'])],
        ]; }
    public static function sortable(): array { return ['id', 'order_id', 'amount', 'method']; }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\Order::class, 'order_id'); }

}