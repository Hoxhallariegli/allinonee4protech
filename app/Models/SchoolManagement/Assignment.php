<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = 'sm_assignments';
    protected $fillable = ['school_class_id', 'subject_id', 'title', 'description', 'due_date'];
    protected function casts(): array { return [
            'due_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'school_class_id' => ['required', 'integer'],
            'subject_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'school_class_id', 'subject_id', 'title', 'description', 'due_date']; }

    public function schoolClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\SchoolClass::class, 'school_class_id'); }

    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Subject::class, 'subject_id'); }

}