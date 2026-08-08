<?php

namespace App\Models\AgricultureManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $table = 'agri_fields';
    protected $fillable = ['name', 'area_size', 'soil_type', 'location_photo'];
    protected function casts(): array { return [
            'area_size' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'area_size' => ['required', 'numeric'],
            'soil_type' => ['required', 'string', 'max:255'],
            'location_photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'area_size', 'soil_type', 'location_photo']; }

}