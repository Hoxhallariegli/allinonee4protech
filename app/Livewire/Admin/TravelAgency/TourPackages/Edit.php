<?php

namespace App\Livewire\Admin\TravelAgency\TourPackages;

use App\Models\TravelAgency\TourPackage;
use App\Domain\TravelAgency\TourPackage\DTOs\TourPackageDTO;
use App\Domain\TravelAgency\TourPackage\Actions\UpdateTourPackageAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit TourPackage')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public TourPackage $item;
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

    public function mount(TourPackage $tourPackage) { $this->item = $tourPackage; $this->fill($tourPackage->toArray());  }
    public function render() {
        abort_if_cannot('edit_tour_packages');
        return view('livewire.admin.travel-agency.tour-packages.edit', [
            'destinations' => $this->getdestinationsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTourPackageAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/tour-packages', 'uploads'); }
 $dto = TourPackageDTO::fromArray([
            'name' => $this->name,
            'destination_id' => $this->destination_id,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('travel-agency/tour-packages.updated')); return to_route('admin.travel-agency.tour-packages.index'); }
    protected function rules(): array { return TourPackage::rules($this->item->id); }
}