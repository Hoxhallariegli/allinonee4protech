<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'fin_documents';
    protected $fillable = ['title', 'file_path', 'file_type'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'title' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'max:255'],
            'file_type' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'title', 'file_path', 'file_type']; }

}