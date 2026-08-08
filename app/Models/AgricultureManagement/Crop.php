<?php

namespace App\Models\AgricultureManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;
    protected $table = 'agri_crops';
    protected $fillable = ['name', 'field_id', 'planting_date', 'status', 'photo'];
    protected function casts(): array { return [
            'planting_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'field_id' => ['required', 'integer'],
            'planting_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['growing', 'harvested'])],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'field_id', 'planting_date', 'status', 'photo']; }

    public function field(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AgricultureManagement\Field::class, 'field_id'); }

}