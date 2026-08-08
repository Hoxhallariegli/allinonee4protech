<?php

namespace App\Models\GymManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'gym_members';
    protected $fillable = ['name', 'email', 'phone', 'membership_plan_id', 'photo'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'membership_plan_id' => ['required', 'integer'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'email', 'phone', 'membership_plan_id', 'photo']; }

    public function membershipPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\GymManagement\MembershipPlan::class, 'membership_plan_id'); }

}