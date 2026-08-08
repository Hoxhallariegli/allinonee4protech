<?php

namespace App\Livewire\Admin\LegalManagement\Clients;

use App\Models\LegalManagement\Client;
use App\Domain\LegalManagement\Client\DTOs\ClientDTO;
use App\Domain\LegalManagement\Client\Actions\CreateClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Client')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
   
    public function render() {
        abort_if_cannot('add_clients');
        return view('livewire.admin.legal-management.clients.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateClientAction $action) { $this->validate();  $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('legal-management/clients.created')); return to_route('admin.legal-management.clients.index'); }
    protected function rules(): array { return Client::rules(); }
}