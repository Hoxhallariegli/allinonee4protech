<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'fin_categories';
    protected $fillable = ['name', 'type'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', \Illuminate\Validation\Rule::in(['income', 'expense'])],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'type']; }

}