<?php

namespace App\Livewire\Admin\BerberApp\Integrations;

use App\Models\BerberApp\DeviceToken;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Device Tokens')]
class DeviceTokens extends Component
{
    use WithPagination;

    public $search = '';

    public function deleteToken($id)
    {
        DeviceToken::destroy($id);
        $this->dispatch('toast', message: 'Token deleted.', type: 'success');
    }

    public function render()
    {
        $tokens = DeviceToken::with(['user', 'booking'])
            ->where(function($q) {
                $q->where('fcm_token', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', fn($sq) => $q->where('name', 'like', '%' . $this->search . '%'))
                  ->orWhereHas('booking', fn($sq) => $q->where('customer_name', 'like', '%' . $this->search . '%'));
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin.berber-app.integrations.device-tokens', [
            'tokens' => $tokens
        ])->layout('components.layouts.app');
    }
}
