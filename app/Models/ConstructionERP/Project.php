<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'ce_projects';
    protected $fillable = ['name', 'client_id', 'start_date', 'budget', 'status'];
    protected function casts(): array { return [
            'start_date' => 'datetime',
            'budget' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'budget' => ['nullable', 'numeric'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['planning', 'active', 'completed'])],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'client_id', 'start_date', 'budget', 'status']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Client::class, 'client_id'); }

}