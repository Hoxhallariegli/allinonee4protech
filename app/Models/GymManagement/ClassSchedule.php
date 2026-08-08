<?php

namespace App\Models\GymManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;
    protected $table = 'gym_class_schedules';
    protected $fillable = ['class_name', 'trainer_id', 'start_time', 'end_time'];
    protected function casts(): array { return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'class_name' => ['required', 'string', 'max:255'],
            'trainer_id' => ['required', 'integer'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'class_name', 'trainer_id', 'start_time', 'end_time']; }

    public function trainer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\GymManagement\Trainer::class, 'trainer_id'); }

}