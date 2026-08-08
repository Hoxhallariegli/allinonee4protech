<?php

namespace App\Models\ECommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'ecom_orders';
    protected $fillable = ['customer_id', 'total', 'status'];
    protected function casts(): array { return [
            'total' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'customer_id' => ['required', 'integer'],
            'total' => ['required', 'numeric'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'shipped', 'delivered'])],
        ]; }
    public static function sortable(): array { return ['id', 'customer_id', 'total', 'status']; }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ECommerce\Customer::class, 'customer_id'); }

}