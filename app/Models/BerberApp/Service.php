<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'ba_services';
    protected $fillable = ['name', 'price', 'duration_minutes'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'duration_minutes' => ['nullable', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'price', 'duration_minutes']; }

}
