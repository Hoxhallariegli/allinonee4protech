<?php

namespace App\Models\RealEstateCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'rec_properties';
    protected $fillable = ['title', 'owner_id', 'agent_id', 'price', 'type', 'photo', 'listing_type'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'owner_id' => ['required', 'integer'],
            'agent_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'type' => ['required', \Illuminate\Validation\Rule::in(['apartment', 'house', 'land'])],
            'photo' => ['nullable', 'max:255'],
            'listing_type' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'owner_id', 'agent_id', 'price', 'type', 'photo', 'listing_type']; }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Owner::class, 'owner_id'); }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Agent::class, 'agent_id'); }

}
