<?php

namespace App\Models\ClinicManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'cm_patients';
    protected $fillable = ['name', 'phone', 'birth_date', 'photo'];
    protected function casts(): array { return [
            'birth_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'phone', 'birth_date', 'photo']; }

}