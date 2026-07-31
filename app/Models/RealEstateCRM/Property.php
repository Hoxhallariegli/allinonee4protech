<?php

namespace App\Models\RealEstateCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'rec_properties';
    protected $fillable = ['title', 'owner_id', 'agent_id', 'no'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'owner_id' => ['required', 'integer'],
            'agent_id' => ['required', 'integer'],
            'no' => ['required', \Illuminate\Validation\Rule::in(['apartment', 'house', 'land'])],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'owner_id', 'agent_id', 'no']; }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Owner::class, 'owner_id'); }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Agent::class, 'agent_id'); }

}