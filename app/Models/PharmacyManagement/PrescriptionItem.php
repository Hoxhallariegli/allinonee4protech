<?php

namespace App\Models\PharmacyManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;
    protected $table = 'pharm_prescription_items';
    protected $fillable = ['prescription_id', 'medicine_id', 'quantity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'prescription_id' => ['required', 'integer'],
            'medicine_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'prescription_id', 'medicine_id', 'quantity']; }

    public function prescription(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\PharmacyManagement\Prescription::class, 'prescription_id'); }

    public function medicine(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\PharmacyManagement\Medicine::class, 'medicine_id'); }

}