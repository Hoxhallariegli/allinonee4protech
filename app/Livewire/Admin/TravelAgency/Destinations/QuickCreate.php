<?php

namespace App\Livewire\Admin\TravelAgency\Destinations;

use App\Models\TravelAgency\Destination;
use App\Domain\TravelAgency\Destination\DTOs\DestinationDTO;
use App\Domain\TravelAgency\Destination\Actions\CreateDestinationAction;
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
    public $country = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.travel-agency.destinations.quick-create', [
        ]); }

    public function store(CreateDestinationAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/destinations', 'uploads'); }
        $dto = DestinationDTO::fromArray([
            'name' => $this->name,
            'country' => $this->country,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('destination-created', id: $item->id);
        $this->js("Livewire.dispatch('destination-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('travel-agency/destinations.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'country', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Destination::rules(); }
}