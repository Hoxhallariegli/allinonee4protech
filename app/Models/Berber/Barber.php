<?php

namespace App\Models\Berber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $table = 'b_barbers';

    protected $fillable = ['name', 'photo', 'specialization', 'active'];

    protected function casts(): array {
        return [
            'active' => 'boolean',
        ];
    }

    public static function rules($id = null): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }

    public static function sortable(): array {
        return ['id', 'name', 'active'];
    }
}
