<?php

namespace App\Models\RealEstateCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'rec_contracts';
    protected $fillable = ['property_id', 'client_id', 'amount'];
    protected function casts(): array { return [
            'amount' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'property_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'property_id', 'client_id', 'amount']; }

    public function property(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Property::class, 'property_id'); }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Client::class, 'client_id'); }

}