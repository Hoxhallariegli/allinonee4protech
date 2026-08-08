<?php

namespace App\Models\WarehouseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'wm_employees';
    protected $fillable = ['name', 'position', 'salary', 'hire_date', 'photo'];
    protected function casts(): array { return [
            'salary' => 'decimal:2',
            'hire_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'hire_date' => ['nullable', 'date'],
            'photo' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'position', 'salary', 'hire_date', 'photo']; }

}