<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'fin_budgets';
    protected $fillable = ['category_id', 'amount', 'period'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'category_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'period' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'category_id', 'amount', 'period']; }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Finance\Category::class, 'category_id'); }

}