<?php

namespace App\Models\LegalManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hearing extends Model
{
    use HasFactory;
    protected $table = 'legal_hearings';
    protected $fillable = ['legal_case_id', 'date', 'location', 'description'];
    protected function casts(): array { return [
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'legal_case_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'legal_case_id', 'date', 'location', 'description']; }

    public function legalCase(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\LegalManagement\LegalCase::class, 'legal_case_id'); }

}
