<?php

namespace App\Livewire\Admin\AgricultureManagement\Fields;

use App\Models\AgricultureManagement\Field;
use App\Domain\AgricultureManagement\Field\DTOs\FieldDTO;
use App\Domain\AgricultureManagement\Field\Actions\CreateFieldAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Field')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $area_size = '';
    public $soil_type = '';
    public $location_photo = '';
   
    public function render() {
        abort_if_cannot('add_fields');
        return view('livewire.admin.agriculture-management.fields.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateFieldAction $action) { $this->validate();         if ($this->location_photo && !is_string($this->location_photo)) { $this->location_photo = $this->location_photo->store('uploads/fields', 'uploads'); }
 $dto = FieldDTO::fromArray([
            'name' => $this->name,
            'area_size' => $this->area_size,
            'soil_type' => $this->soil_type,
            'location_photo' => $this->location_photo,
        ]); $action->execute($dto); session()->flash('success', __('agriculture-management/fields.created')); return to_route('admin.agriculture-management.fields.index'); }
    protected function rules(): array { return Field::rules(); }
}