<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price', 'sale_date', 'status', 'notes', 'no'];
    protected function casts(): array { return [
            'sale_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'user_id' => ['required'],
            'new_user_name' => ['required_if:user_id,new'],
            'product_id' => ['required'],
            'new_product_name' => ['required_if:product_id,new'],
            'quantity' => ['required', 'numeric'],
            'total_price' => ['required'],
            'sale_date' => ['required', 'date'],
            'status' => ['required', 'in:pending,completed,cancelled'],
            'notes' => ['nullable'],
            'no' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'user_id', 'product_id', 'quantity', 'total_price', 'sale_date', 'status', 'no']; }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

}