<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalVital extends Model
{
    use HasFactory;
    protected $table = 'cm_medical_vitals';
    protected $fillable = ['patient_id', 'weight_kg', 'blood_pressure', 'pulse_bpm', 'temperature_c', 'recorded_at'];
    protected function casts(): array { return [
            'weight_kg' => 'decimal:2',
            'temperature_c' => 'decimal:2',
            'recorded_at' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'patient_id' => ['required', 'integer'],
            'weight_kg' => ['nullable', 'numeric'],
            'blood_pressure' => ['nullable', 'string', 'max:255'],
            'pulse_bpm' => ['nullable', 'integer'],
            'temperature_c' => ['nullable', 'numeric'],
            'recorded_at' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'patient_id', 'weight_kg', 'blood_pressure', 'pulse_bpm', 'temperature_c', 'recorded_at']; }

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Patient::class, 'patient_id'); }

}