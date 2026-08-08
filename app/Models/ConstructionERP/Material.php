<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'ce_materials';
    protected $fillable = ['name', 'unit', 'price', 'stock', 'photo'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['nullable', 'integer'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'unit', 'price', 'stock', 'photo']; }

}