<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'ba_services';
    protected $fillable = ['name', 'duration_minutes', 'price', 'active'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
            'active' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'active' => ['required', 'boolean'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'duration_minutes', 'price', 'active']; }

}