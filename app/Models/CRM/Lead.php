<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'c_leads';
    protected $fillable = ['name', 'company_id', 'source', 'status'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer'],
            'source' => ['nullable', 'string', 'max:255'],
            'status' => ['required', \Illuminate\Validation\Rule::in(['new', 'contacted', 'qualified'])],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'company_id', 'source', 'status']; }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Company::class, 'company_id'); }

}