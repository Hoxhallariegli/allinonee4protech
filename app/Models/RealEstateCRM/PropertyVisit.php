<?php

namespace App\Models\RealEstateCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyVisit extends Model
{
    use HasFactory;
    protected $table = 'rec_property_visits';
    protected $fillable = ['property_id', 'client_id', 'visit_date'];
    protected function casts(): array { return [
            'visit_date' => 'datetime',
        ]; }
    public static function rules($id = null): array { return [
            'property_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
            'visit_date' => ['required', 'date'],
        ]; }
    public static function sortable(): array { return ['id', 'property_id', 'client_id', 'visit_date']; }

    public function property(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\RealEstateCRM\Property::class, 'property_id'); }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\ConstructionERP\Client::class, 'client_id'); }

}