<?php

namespace App\Models\AutoRepairManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'arm_customer_addresses';
    protected $fillable = ['customer_id', 'address'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'customer_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'customer_id', 'address']; }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Customer::class, 'customer_id'); }

}