<?php

namespace App\Models\FleetManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'fl_vehicles';
    protected $fillable = ['make', 'model', 'year', 'license_plate', 'photo', 'type'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'license_plate' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'make', 'model', 'year', 'license_plate', 'photo', 'type']; }

}
