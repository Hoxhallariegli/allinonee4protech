<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'cm_prescriptions';
    protected $fillable = ['visit_id', 'medicine', 'dosage'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'visit_id' => ['required', 'integer'],
            'medicine' => ['required', 'string', 'max:255'],
            'dosage' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'visit_id', 'medicine', 'dosage']; }

    public function visit(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Visit::class, 'visit_id'); }

}