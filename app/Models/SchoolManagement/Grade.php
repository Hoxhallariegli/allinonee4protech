<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'sm_grades';
    protected $fillable = ['student_id', 'exam_id', 'score'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'student_id' => ['required', 'integer'],
            'exam_id' => ['required', 'integer'],
            'score' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'student_id', 'exam_id', 'score']; }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Student::class, 'student_id'); }

    public function exam(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Exam::class, 'exam_id'); }

}