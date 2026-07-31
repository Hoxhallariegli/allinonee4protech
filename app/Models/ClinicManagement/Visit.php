<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'cm_visits';
    protected $fillable = ['patient_id', 'doctor_id', 'visit_date', 'diagnosis'];
    protected function casts(): array { return [
            'visit_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'patient_id' => ['required', 'integer'],
            'doctor_id' => ['required', 'integer'],
            'visit_date' => ['required', 'date'],
            'diagnosis' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'patient_id', 'doctor_id', 'visit_date', 'diagnosis']; }

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Patient::class, 'patient_id'); }

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ClinicManagement\Doctor::class, 'doctor_id'); }

}