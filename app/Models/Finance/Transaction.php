<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'fin_transactions';
    protected $fillable = ['account_id', 'category_id', 'amount', 'date', 'description'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'account_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ]; }
    public static function sortable(): array { return ['id', 'account_id', 'category_id', 'amount', 'date', 'description']; }

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Finance\Account::class, 'account_id'); }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Finance\Category::class, 'category_id'); }

}