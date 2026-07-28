<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['part_id', 'quantity'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'part_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]; }
    public static function sortable(): array { return ['id', 'part_id', 'quantity']; }

    public function part(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\Part::class, 'part_id'); }

}