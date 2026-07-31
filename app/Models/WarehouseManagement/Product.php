<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'wm_products';
    protected $fillable = ['name', 'category_id', 'price', 'stock'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'stock' => ['nullable', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'category_id', 'price', 'stock']; }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\WarehouseManagement\Category::class, 'category_id'); }

}