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

#[Title('Add Destination')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $country = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_destinations');
        return view('livewire.admin.travel-agency.destinations.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDestinationAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/destinations', 'uploads'); }
 $dto = DestinationDTO::fromArray([
            'name' => $this->name,
            'country' => $this->country,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('travel-agency/destinations.created')); return to_route('admin.travel-agency.destinations.index'); }
    protected function rules(): array { return Destination::rules(); }
}