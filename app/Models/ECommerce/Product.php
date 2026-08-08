<?php

namespace App\Models\ECommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'ecom_products';
    protected $fillable = ['name', 'photo', 'price', 'stock', 'vendor_id', 'category_id'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'vendor_id' => ['required', 'integer'],
            'category_id' => ['nullable', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'price', 'stock', 'vendor_id', 'category_id']; }

    public function vendor(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ECommerce\Vendor::class, 'vendor_id'); }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ECommerce\Category::class, 'category_id'); }

}
