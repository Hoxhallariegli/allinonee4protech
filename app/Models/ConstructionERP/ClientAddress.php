<?php

namespace App\Models\ConstructionERP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;
    protected $table = 'ce_client_addresses';
    protected $fillable = ['client_id', 'address'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'client_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'client_id', 'address']; }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Client::class, 'client_id'); }

}