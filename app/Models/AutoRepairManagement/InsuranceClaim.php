<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceClaim extends Model
{
    use HasFactory;
    protected $table = 'arm_insurance_claims';
    protected $fillable = ['vehicle_id', 'policy_number', 'amount', 'status'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'policy_number' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'policy_number', 'amount', 'status']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Vehicle::class, 'vehicle_id'); }

}