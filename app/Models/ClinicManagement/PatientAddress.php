<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAddress extends Model
{
    use HasFactory;
    protected $table = 'cm_patient_addresses';
    protected $fillable = ['patient_id', 'line1', 'city'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'patient_id' => ['required', 'integer'],
            'line1' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'patient_id', 'line1', 'city']; }

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Patient::class, 'patient_id'); }

}