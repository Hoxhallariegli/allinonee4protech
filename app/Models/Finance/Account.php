<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'fin_accounts';
    protected $fillable = ['name', 'type', 'balance'];
    protected function casts(): array { return [
            'balance' => 'decimal:2',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'numeric'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'type', 'balance']; }

}