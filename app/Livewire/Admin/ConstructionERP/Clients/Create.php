<?php

namespace App\Livewire\Admin\ConstructionERP\Clients;

use App\Models\ConstructionERP\Client;
use App\Domain\ConstructionERP\Client\DTOs\ClientDTO;
use App\Domain\ConstructionERP\Client\Actions\CreateClientAction;
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
    public $phone = '';
   
    public function render() { abort_if_cannot('add_clients'); return view('livewire.admin.construction-e-r-p.clients.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateClientAction $action) { $this->validate();  $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/clients.created')); return to_route('admin.construction-e-r-p.clients.index'); }
    protected function rules(): array { return Client::rules(); }
}