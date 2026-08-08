<?php

namespace App\Livewire\Admin\RealEstateCRM\Properties;

use App\Models\RealEstateCRM\Property;
use App\Domain\RealEstateCRM\Property\DTOs\PropertyDTO;
use App\Domain\RealEstateCRM\Property\Actions\CreatePropertyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Property')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $title = '';
    public $owner_id = '';
    public $agent_id = '';
    public $price = '';
    public $type = '';
    public $photo = '';
 
    #[On('owner-created')] 
    public function refreshOwners($id) { $this->owner_id = $id; $this->updatedOwnerId($id); }

    #[On('agent-created')] 
    public function refreshAgents($id) { $this->agent_id = $id; $this->updatedAgentId($id); }
 
    public function updatedOwnerId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Owner::find($value);
        if (!$related) return;
    }

    public function updatedAgentId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Agent::find($value);
        if (!$related) return;
    }
 
    protected function getownersList() {
        return \App\Models\RealEstateCRM\Owner::pluck('name', 'id')->toArray();
    }

    protected function getagentsList() {
        return \App\Models\RealEstateCRM\Agent::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_properties');
        return view('livewire.admin.real-estate-c-r-m.properties.create', [
            'owners' => $this->getownersList(),
            'agents' => $this->getagentsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreatePropertyAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/properties', 'uploads'); }
 $dto = PropertyDTO::fromArray([
            'title' => $this->title,
            'owner_id' => $this->owner_id,
            'agent_id' => $this->agent_id,
            'price' => $this->price,
            'type' => $this->type,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/properties.created')); return to_route('admin.real-estate-c-r-m.properties.index'); }
    protected function rules(): array { return Property::rules(); }
}