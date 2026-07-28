<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id', 'model_id', 'year', 'customer_id', 'license_plate', 'vin'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'brand_id' => ['required', 'integer'],
            'model_id' => ['required', 'integer'],
            'year' => ['nullable', 'integer'],
            'customer_id' => ['required', 'integer'],
            'license_plate' => ['nullable', 'string', 'max:255'],
            'vin' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'brand_id', 'model_id', 'year', 'customer_id', 'license_plate', 'vin']; }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\VehicleBrand::class, 'brand_id'); }

    public function model(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\VehicleModel::class, 'model_id'); }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Customer::class, 'customer_id'); }

}