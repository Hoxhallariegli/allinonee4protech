<?php

namespace App\Models\PharmacyManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'pharm_prescriptions';
    protected $fillable = ['patient_name', 'doctor_name', 'date', 'photo'];
    protected function casts(): array { return [
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'patient_name' => ['required', 'string', 'max:255'],
            'doctor_name' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'patient_name', 'doctor_name', 'date', 'photo']; }

}