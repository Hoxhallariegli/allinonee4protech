<?php

namespace App\Models\RestaurantPOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningTable extends Model
{
    use HasFactory;
    protected $table = 'rp_dining_tables';
    protected $fillable = ['number', 'capacity', 'status'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'number' => ['required', 'string', 'max:255'],
            'capacity' => ['nullable', 'integer'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['free', 'occupied'])],
        ]; }
    public static function sortable(): array { return ['id', 'number', 'capacity', 'status']; }

}