<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'arm_reports';
    protected $fillable = ['report_type', 'report_date'];
    protected function casts(): array { return [
            'report_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'report_type' => ['required', 'string', 'max:255'],
            'report_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'report_type', 'report_date']; }

}