<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $table = 'hr_leave_requests';
    protected $fillable = ['employee_id', 'leave_type', 'start_date', 'end_date', 'status'];
    protected function casts(): array { return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'employee_id' => ['required', 'integer'],
            'leave_type' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'approved', 'rejected'])],
        ]; }
    public static function sortable(): array { return ['id', 'employee_id', 'leave_type', 'start_date', 'end_date', 'status']; }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HumanResources\Employee::class, 'employee_id'); }

}