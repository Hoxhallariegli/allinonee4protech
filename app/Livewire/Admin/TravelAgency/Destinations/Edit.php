<?php

namespace App\Livewire\Admin\TravelAgency\Destinations;

use App\Models\TravelAgency\Destination;
use App\Domain\TravelAgency\Destination\DTOs\DestinationDTO;
use App\Domain\TravelAgency\Destination\Actions\UpdateDestinationAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Destination')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Destination $item;
    public $name = '';
    public $country = '';
    public $photo = '';
   
    public function mount(Destination $destination) { $this->item = $destination; $this->fill($destination->toArray());  }
    public function render() {
        abort_if_cannot('edit_destinations');
        return view('livewire.admin.travel-agency.destinations.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDestinationAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/destinations', 'uploads'); }
 $dto = DestinationDTO::fromArray([
            'name' => $this->name,
            'country' => $this->country,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('travel-agency/destinations.updated')); return to_route('admin.travel-agency.destinations.index'); }
    protected function rules(): array { return Destination::rules($this->item->id); }
}