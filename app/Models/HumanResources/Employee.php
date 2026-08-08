<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'hr_employees';
    protected $fillable = ['name', 'email', 'phone', 'department_id', 'hire_date', 'photo'];
    protected function casts(): array { return [
            'hire_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'integer'],
            'hire_date' => ['required', 'date'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'email', 'phone', 'department_id', 'hire_date', 'photo']; }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HumanResources\Department::class, 'department_id'); }

}