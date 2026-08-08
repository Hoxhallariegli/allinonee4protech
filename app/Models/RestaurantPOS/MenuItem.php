<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $table = 'rp_menu_items';
    protected $fillable = ['name', 'price', 'category_id', 'photo'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'category_id' => ['nullable', 'integer'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'price', 'category_id', 'photo']; }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\Category::class, 'category_id'); }

}
