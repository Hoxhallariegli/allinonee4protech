<?php

namespace App\Models\RealEstateCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'rec_payments';
    protected $fillable = ['client_id', 'amount', 'payment_date'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'client_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'client_id', 'amount', 'payment_date']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Client::class, 'client_id'); }

}