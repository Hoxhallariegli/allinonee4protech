<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTracking extends Model
{
    use HasFactory;
    protected $table = 'arm_expense_trackings';
    protected $fillable = ['description', 'amount', 'date'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'description', 'amount', 'date']; }

}