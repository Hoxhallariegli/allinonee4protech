<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'sm_payments';
    protected $fillable = ['student_id', 'amount', 'payment_date'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'student_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'student_id', 'amount', 'payment_date']; }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Student::class, 'student_id'); }

}