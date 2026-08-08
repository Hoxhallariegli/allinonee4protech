<?php

namespace App\Livewire\Admin\ConstructionERP\Clients;

use App\Models\ConstructionERP\Client;
use App\Domain\ConstructionERP\Client\DTOs\ClientDTO;
use App\Domain\ConstructionERP\Client\Actions\UpdateClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Client')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Client $item;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $photo = '';
   
    public function mount(Client $client) { $this->item = $client; $this->fill($client->toArray());  }
    public function render() {
        abort_if_cannot('edit_clients');
        return view('livewire.admin.construction-e-r-p.clients.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClientAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/clients', 'uploads'); }
 $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/clients.updated')); return to_route('admin.construction-e-r-p.clients.index'); }
    protected function rules(): array { return Client::rules($this->item->id); }
}