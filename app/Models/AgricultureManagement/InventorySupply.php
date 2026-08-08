<?php

namespace App\Models\AgricultureManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventorySupply extends Model
{
    use HasFactory;
    protected $table = 'agri_inventory_supplies';
    protected $fillable = ['name', 'stock_quantity', 'unit'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'stock_quantity' => ['required', 'integer'],
            'unit' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'stock_quantity', 'unit']; }

}