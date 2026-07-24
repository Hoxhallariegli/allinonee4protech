<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'price', 'quantity', 'no'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'new_category_name' => ['required_if:category_id,new'],
            'price' => ['required'],
            'quantity' => ['required', 'numeric'],
            'no' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'category_id', 'price', 'quantity', 'no']; }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

}