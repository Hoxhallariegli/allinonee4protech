<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $table = 'c_deals';
    protected $fillable = ['name', 'contact_id', 'value', 'stage'];
    protected function casts(): array { return [
            'value' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'contact_id' => ['required', 'integer'],
            'value' => ['required', 'numeric'],
            'stage' => ['required', \Illuminate\Validation\Rule::in(['prospecting', 'negotiation', 'won', 'lost'])],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'contact_id', 'value', 'stage']; }

    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Contact::class, 'contact_id'); }

}