<?php

namespace App\Models\LegalManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'legal_documents';
    protected $fillable = ['case_id', 'title', 'file_path'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'case_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'case_id', 'title', 'file_path']; }

    public function case(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\LegalManagement\LegalCase::class, 'case_id'); }

}