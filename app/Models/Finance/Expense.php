<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'fin_expenses';
    protected $fillable = ['amount', 'date', 'category_id', 'attachment_file'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'category_id' => ['required', 'integer'],
            'attachment_file' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'amount', 'date', 'category_id', 'attachment_file']; }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Finance\Category::class, 'category_id'); }

}