<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'ba_customers';

    protected $fillable = ['name', 'phone', 'email'];

    public static function rules($id = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:ba_customers,phone,' . $id],
            'email' => ['nullable', 'email', 'max:255'],
        ];
    }

    public static function sortable(): array
    {
        return ['id', 'name', 'phone', 'email'];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
