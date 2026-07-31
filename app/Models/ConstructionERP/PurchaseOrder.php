<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'ce_purchase_orders';
    protected $fillable = ['supplier_id', 'project_id', 'order_date', 'status'];
    protected function casts(): array { return [
            'order_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'supplier_id' => ['required', 'integer'],
            'project_id' => ['required', 'integer'],
            'order_date' => ['required', 'date'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'delivered'])],
        ]; }
    public static function sortable(): array { return ['id', 'supplier_id', 'project_id', 'order_date', 'status']; }

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\AutoRepairManagement\Supplier::class, 'supplier_id'); }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Project::class, 'project_id'); }

}