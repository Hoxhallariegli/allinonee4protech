<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'ce_contracts';
    protected $fillable = ['project_id', 'client_id', 'contract_date', 'amount'];
    protected function casts(): array { return [
            'contract_date' => 'datetime',
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'project_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
            'contract_date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'project_id', 'client_id', 'contract_date', 'amount']; }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Project::class, 'project_id'); }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Client::class, 'client_id'); }

}