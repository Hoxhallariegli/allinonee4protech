<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $table = 'sm_school_classes';
    protected $fillable = ['name', 'teacher_id', 'capacity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required', 'integer'],
            'capacity' => ['nullable', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'teacher_id', 'capacity']; }

    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Teacher::class, 'teacher_id'); }

}