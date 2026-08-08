<?php

namespace App\Models\PharmacyManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = 'pharm_medicines';
    protected $fillable = ['name', 'category', 'price', 'stock', 'photo'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'category', 'price', 'stock', 'photo']; }

}