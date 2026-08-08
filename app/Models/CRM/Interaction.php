<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    protected $table = 'c_interactions';
    protected $fillable = ['contact_id', 'type', 'notes'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'contact_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'contact_id', 'type', 'notes']; }

    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Contact::class, 'contact_id'); }

}