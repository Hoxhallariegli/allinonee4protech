<?php

namespace App\Models\LegalManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    use HasFactory;
    protected $table = 'legal_legal_cases';
    protected $fillable = ['title', 'client_id', 'status', 'description', 'case_number'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'integer'],
            'case_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['open', 'closed', 'appealed', 'pending'])],
            'description' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'client_id', 'status', 'description', 'case_number']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\LegalManagement\Client::class, 'client_id'); }

}
