<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    use HasFactory;
    protected $table = 'c_contact_addresses';
    protected $fillable = ['contact_id', 'address'];
    protected function casts(): array { return [
        ]; }
    public static function rules($id = null): array { return [
            'contact_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
        ]; }
    public static function sortable(): array { return ['id', 'contact_id', 'address']; }

    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(\App\Models\CRM\Contact::class, 'contact_id'); }

}