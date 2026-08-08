<?php

namespace App\Models\GymManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'gym_subscriptions';
    protected $fillable = ['member_id', 'start_date', 'end_date', 'status'];
    protected function casts(): array { return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'member_id' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['active', 'expired', 'cancelled'])],
        ]; }
    public static function sortable(): array { return ['id', 'member_id', 'start_date', 'end_date', 'status']; }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\GymManagement\Member::class, 'member_id'); }

}