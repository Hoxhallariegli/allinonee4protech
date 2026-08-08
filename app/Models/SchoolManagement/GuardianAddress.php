<?php

namespace App\Models\SchoolManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianAddress extends Model
{
    use HasFactory;
    protected $table = 'sm_guardian_addresses';
    protected $fillable = ['guardian_id', 'line1', 'city'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'guardian_id' => ['required', 'integer'],
            'line1' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'guardian_id', 'line1', 'city']; }

    public function guardian(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\SchoolManagement\Guardian::class, 'guardian_id'); }

}