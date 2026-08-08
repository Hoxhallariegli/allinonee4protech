<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'hr_departments';
    protected $fillable = ['name', 'description'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'description']; }

}