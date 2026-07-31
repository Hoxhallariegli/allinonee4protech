<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    use HasFactory;
    protected $table = 'ce_progress_reports';
    protected $fillable = ['project_id', 'report_date', 'percentage'];
    protected function casts(): array { return [
            'report_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'project_id' => ['required', 'integer'],
            'report_date' => ['required', 'date'],
            'percentage' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'project_id', 'report_date', 'percentage']; }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Project::class, 'project_id'); }

}