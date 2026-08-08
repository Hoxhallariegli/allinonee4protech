<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'hr_payrolls';
    protected $fillable = ['employee_id', 'month', 'amount', 'is_paid'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'is_paid' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'employee_id' => ['required', 'integer'],
            'month' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'is_paid' => ['nullable', 'boolean'],
        ]; }
    public static function sortable(): array { return ['id', 'employee_id', 'month', 'amount', 'is_paid']; }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\HumanResources\Employee::class, 'employee_id'); }

}