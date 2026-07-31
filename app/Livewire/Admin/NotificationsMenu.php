<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

use Livewire\Attributes\On;
use App\Models\BerberApp\DeviceToken;

class NotificationsMenu extends Component
{
    public int $unseenCount = 0;

    #[On('fcm-token-received')]
    public function saveToken($token)
    {
        if (!auth()->check()) return;

        // Handle both string and array (Livewire event payload)
        $tokenValue = is_array($token) ? ($token['token'] ?? $token[0] ?? null) : $token;

        if (!$tokenValue) return;

        DeviceToken::updateOrCreate(
            ['user_id' => auth()->id(), 'fcm_token' => $tokenValue],
            ['device_type' => 'web']
        );
    }

    public function mount(): void
    {
        $this->unseenCount = Notification::where('assigned_to_user_id', auth()->id())->where('viewed', 0)->count();
    }

    public function render(): View
    {
        $notifications = Notification::where('assigned_to_user_id', auth()->id())
            ->latest()
            ->take(20)
            ->get();

        return view('livewire.admin.notifications-menu', [
            'notifications' => $notifications
        ]);
    }

    public function open(): void
    {
        Notification::where('assigned_to_user_id', auth()->id())
            ->where('viewed', 0)
            ->update([
                'viewed' => 1,
                'viewed_at' => now(),
            ]);
    }
}
