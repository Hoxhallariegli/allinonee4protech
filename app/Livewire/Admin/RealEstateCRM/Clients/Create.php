<?php

namespace App\Livewire\Admin\RealEstateCRM\Clients;

use App\Models\RealEstateCRM\Client;
use App\Domain\RealEstateCRM\Client\DTOs\ClientDTO;
use App\Domain\RealEstateCRM\Client\Actions\CreateClientAction;
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
    public $phone = '';
    public $email = '';
   
    public function render() { abort_if_cannot('add_clients'); return view('livewire.admin.real-estate-c-r-m.clients.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateClientAction $action) { $this->validate();  $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/clients.created')); return to_route('admin.real-estate-c-r-m.clients.index'); }
    protected function rules(): array { return Client::rules(); }
}