<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $table = 'sm_timetables';
    protected $fillable = ['school_class_id', 'subject_id', 'teacher_id', 'day', 'start_time', 'end_time'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'school_class_id' => ['required', 'integer'],
            'subject_id' => ['required', 'integer'],
            'teacher_id' => ['required', 'integer'],
            'day' => ['required', \Illuminate\Validation\Rule::in(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'])],
            'start_time' => ['required', 'string', 'max:255'],
            'end_time' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'school_class_id', 'subject_id', 'teacher_id', 'day', 'start_time', 'end_time']; }

    public function schoolClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\SchoolClass::class, 'school_class_id'); }

    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Subject::class, 'subject_id'); }

    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Teacher::class, 'teacher_id'); }

}