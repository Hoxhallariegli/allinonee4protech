<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_id', 'customer_id', 'mechanic_id', 'status', 'opened_at', 'closed_at'];
    protected function casts(): array { return [
            'opened_at' => 'datetime',
            'closed_at' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'vehicle_id' => ['required', 'integer'],
            'customer_id' => ['required', 'integer'],
            'mechanic_id' => ['required', 'integer'],
            'status' => ['required', 'string', 'max:255'],
            'opened_at' => ['nullable', 'date'],
            'closed_at' => ['nullable', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'vehicle_id', 'customer_id', 'mechanic_id', 'status', 'opened_at', 'closed_at']; }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Vehicle::class, 'vehicle_id'); }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Customer::class, 'customer_id'); }

    public function mechanic(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Mechanic::class, 'mechanic_id'); }

}