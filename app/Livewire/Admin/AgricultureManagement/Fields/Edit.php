<?php

namespace App\Livewire\Admin\AgricultureManagement\Fields;

use App\Models\AgricultureManagement\Field;
use App\Domain\AgricultureManagement\Field\DTOs\FieldDTO;
use App\Domain\AgricultureManagement\Field\Actions\UpdateFieldAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Field')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Field $item;
    public $name = '';
    public $area_size = '';
    public $soil_type = '';
    public $location_photo = '';
   
    public function mount(Field $field) { $this->item = $field; $this->fill($field->toArray());  }
    public function render() {
        abort_if_cannot('edit_fields');
        return view('livewire.admin.agriculture-management.fields.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateFieldAction $action) { $this->validate();         if ($this->location_photo && !is_string($this->location_photo)) { $this->location_photo = $this->location_photo->store('uploads/fields', 'uploads'); }
 $dto = FieldDTO::fromArray([
            'name' => $this->name,
            'area_size' => $this->area_size,
            'soil_type' => $this->soil_type,
            'location_photo' => $this->location_photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('agriculture-management/fields.updated')); return to_route('admin.agriculture-management.fields.index'); }
    protected function rules(): array { return Field::rules($this->item->id); }
}