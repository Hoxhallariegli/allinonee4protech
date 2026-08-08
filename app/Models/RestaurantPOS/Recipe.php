<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'rp_recipes';
    protected $fillable = ['menu_item_id', 'ingredient_id', 'quantity_required'];
    protected function casts(): array { return [
            'quantity_required' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'menu_item_id' => ['required', 'integer'],
            'ingredient_id' => ['required', 'integer'],
            'quantity_required' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'menu_item_id', 'ingredient_id', 'quantity_required']; }

    public function menuItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\MenuItem::class, 'menu_item_id'); }

    public function ingredient(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RestaurantPOS\Ingredient::class, 'ingredient_id'); }

}