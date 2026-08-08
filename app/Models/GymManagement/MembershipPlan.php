<?php

namespace App\Models\GymManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;
    protected $table = 'gym_membership_plans';
    protected $fillable = ['name', 'price', 'duration_days'];
    protected function casts(): array { return [
            'price' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'duration_days' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'price', 'duration_days']; }

}