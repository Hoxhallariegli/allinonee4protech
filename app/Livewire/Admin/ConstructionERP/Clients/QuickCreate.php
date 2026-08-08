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
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $email = '';
    public $phone = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.clients.quick-create', [
        ]); }

    public function store(CreateClientAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/clients', 'uploads'); }
        $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('client-created', id: $item->id);
        $this->js("Livewire.dispatch('client-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/clients.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Client::rules(); }
}