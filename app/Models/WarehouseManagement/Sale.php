<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'wm_sales';
    protected $fillable = ['customer_id', 'sale_date', 'total'];
    protected function casts(): array { return [
            'sale_date' => 'datetime',
            'total' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'customer_id' => ['required', 'integer'],
            'sale_date' => ['required', 'date'],
            'total' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'customer_id', 'sale_date', 'total']; }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Customer::class, 'customer_id'); }

}