<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'sm_attendances';
    protected $fillable = ['student_id', 'class_id', 'date', 'status'];
    protected function casts(): array { return [
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'student_id' => ['required', 'integer'],
            'class_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['present', 'absent', 'late'])],
        ]; }
    public static function sortable(): array { return ['id', 'student_id', 'class_id', 'date', 'status']; }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Student::class, 'student_id'); }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\SchoolClass::class, 'class_id'); }

}