<?php

namespace App\Livewire\Admin\LegalManagement\Clients;

use App\Models\LegalManagement\Client;
use App\Domain\LegalManagement\Client\DTOs\ClientDTO;
use App\Domain\LegalManagement\Client\Actions\UpdateClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Client')]
class Edit extends Component
{
        use WithPagination;
 public Client $item;
    public $name = '';
    public $email = '';
   
    public function mount(Client $client) { $this->item = $client; $this->fill($client->toArray());  }
    public function render() {
        abort_if_cannot('edit_clients');
        return view('livewire.admin.legal-management.clients.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClientAction $action) { $this->validate();  $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('legal-management/clients.updated')); return to_route('admin.legal-management.clients.index'); }
    protected function rules(): array { return Client::rules($this->item->id); }
}