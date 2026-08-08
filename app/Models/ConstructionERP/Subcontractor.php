<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    use HasFactory;
    protected $table = 'ce_subcontractors';
    protected $fillable = ['project_id', 'name'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'project_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'project_id', 'name']; }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Project::class, 'project_id'); }

}