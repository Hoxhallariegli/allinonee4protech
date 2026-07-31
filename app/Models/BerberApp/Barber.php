<?php

namespace App\Models\BerberApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;
    protected $table = 'ba_barbers';
    protected $fillable = ['name', 'photo', 'specialization', 'active'];
    protected function casts(): array { return [
            'active' => 'boolean',
        ]; }
    public static function rules($id = null): array { return [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string'],
            'active' => ['required', 'boolean'],
        ]; }
    public static function sortable(): array { return ['id', 'name', 'photo', 'specialization', 'active']; }

    public function exceptions()
    {
        return $this->hasMany(BarberException::class);
    }

    public function workingHours()
    {
        return $this->hasMany(BarberWorkingHour::class);
    }
}
