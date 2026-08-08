<?php

namespace App\Models\PharmacyManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'pharm_sales';
    protected $fillable = ['total_amount', 'sale_date'];
    protected function casts(): array { return [
            'total_amount' => 'decimal:2',
            'sale_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'total_amount' => ['required', 'numeric'],
            'sale_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'total_amount', 'sale_date']; }

}