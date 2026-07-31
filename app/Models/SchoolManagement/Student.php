<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'sm_students';
    protected $fillable = ['name', 'guardian_id', 'class_id', 'birth_date'];
    protected function casts(): array { return [
            'birth_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'guardian_id' => ['required', 'integer'],
            'class_id' => ['required', 'integer'],
            'birth_date' => ['nullable', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'guardian_id', 'class_id', 'birth_date']; }

    public function guardian(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Guardian::class, 'guardian_id'); }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\SchoolClass::class, 'class_id'); }

}