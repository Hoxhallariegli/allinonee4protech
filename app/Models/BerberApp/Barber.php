<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $table = 'ba_barbers';

    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'specialization',
        'active'
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'string',
            'active' => 'boolean',
        ];
    }

    public static function rules($id = null): array
    {
        return [
            'user_id' => ['nullable', 'string', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'], // For validation during upload
            'specialization' => ['nullable', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }

    public static function sortable(): array
    {
        return ['id', 'user_id', 'name', 'photo', 'specialization', 'active'];
    }

    public function exceptions()
    {
        return $this->hasMany(BarberException::class);
    }

    public function workingHours()
    {
        return $this->hasMany(BarberWorkingHour::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
