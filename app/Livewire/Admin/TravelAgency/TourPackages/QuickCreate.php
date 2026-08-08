<?php

namespace App\Livewire\Admin\TravelAgency\TourPackages;

use App\Models\TravelAgency\TourPackage;
use App\Domain\TravelAgency\TourPackage\DTOs\TourPackageDTO;
use App\Domain\TravelAgency\TourPackage\Actions\CreateTourPackageAction;
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
    public $destination_id = '';
    public $price = '';
    public $duration_days = '';
    public $photo = '';
 
    #[On('destination-created')] 
    public function refreshDestinations($id) { $this->destination_id = $id; $this->updatedDestinationId($id); }
 
    public function updatedDestinationId($value)
    {
        if (!$value) return;
        $related = \App\Models\TravelAgency\Destination::find($value);
        if (!$related) return;
    }
 
    protected function getdestinationsList() {
        return \App\Models\TravelAgency\Destination::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.travel-agency.tour-packages.quick-create', [
            'destinations' => $this->getdestinationsList(),
        ]); }

    public function store(CreateTourPackageAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/tour-packages', 'uploads'); }
        $dto = TourPackageDTO::fromArray([
            'name' => $this->name,
            'destination_id' => $this->destination_id,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('tour-package-created', id: $item->id);
        $this->js("Livewire.dispatch('tour-package-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('travel-agency/tour-packages.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'destination_id', 'price', 'duration_days', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return TourPackage::rules(); }
}