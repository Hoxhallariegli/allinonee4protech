<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $table = 'ba_notification_settings';

    protected $fillable = ['user_id', 'module', 'event_type', 'enabled'];

    protected function casts(): array {
        return [
            'enabled' => 'boolean',
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
