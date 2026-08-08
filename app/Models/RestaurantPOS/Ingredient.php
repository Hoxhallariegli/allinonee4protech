<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $table = 'rp_ingredients';
    protected $fillable = ['name', 'stock_quantity', 'unit'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'stock_quantity' => ['required', 'integer'],
            'unit' => ['required', \Illuminate\Validation\Rule::in(['kg', 'liters', 'pcs', 'grams'])],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'stock_quantity', 'unit']; }

}