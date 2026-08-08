<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'label',
        'icon',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function isActive(string $key): bool
    {
        $modules = Cache::rememberForever('active_modules', function () {
            return self::where('is_active', true)->pluck('key')->toArray();
        });

        return in_array($key, $modules);
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('active_modules');
        });

        static::deleted(function () {
            Cache::forget('active_modules');
        });
    }
}
