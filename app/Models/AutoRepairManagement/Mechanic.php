<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;
    protected $table = 'arm_mechanics';
    protected $fillable = ['employee_id', 'specialization'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'employee_id' => ['required', 'integer'],
            'specialization' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'employee_id', 'specialization']; }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Employee::class, 'employee_id'); }

}