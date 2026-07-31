<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'ce_apartments';
    protected $fillable = ['building_id', 'number', 'area', 'status'];
    protected function casts(): array { return [
            'area' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'building_id' => ['required', 'integer'],
            'number' => ['required', 'string', 'max:255'],
            'area' => ['nullable', 'numeric'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['available', 'sold', 'reserved'])],
        ]; }
    public static function sortable(): array { return ['id', 'building_id', 'number', 'area', 'status']; }

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Building::class, 'building_id'); }

}