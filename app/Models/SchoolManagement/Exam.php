<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'sm_exams';
    protected $fillable = ['name', 'class_id', 'exam_date'];
    protected function casts(): array { return [
            'exam_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'class_id' => ['required', 'integer'],
            'exam_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'class_id', 'exam_date']; }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\SchoolClass::class, 'class_id'); }

}