<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'c_contacts';
    protected $fillable = ['name', 'company_id', 'email', 'photo'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer'],
            'email' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'company_id', 'email', 'photo']; }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Company::class, 'company_id'); }

}