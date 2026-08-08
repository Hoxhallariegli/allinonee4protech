<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'hr_attendances';
    protected $fillable = ['employee_id', 'date', 'clock_in', 'clock_out'];
    protected function casts(): array { return [
            'date' => 'datetime',
            'clock_in' => 'datetime',
            'clock_out' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'employee_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'clock_in' => ['nullable', 'date'],
            'clock_out' => ['nullable', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'employee_id', 'date', 'clock_in', 'clock_out']; }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HumanResources\Employee::class, 'employee_id'); }

}