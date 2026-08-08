<?php

namespace App\Livewire\Admin\AgricultureManagement\Crops;

use App\Models\AgricultureManagement\Crop;
use App\Domain\AgricultureManagement\Crop\DTOs\CropDTO;
use App\Domain\AgricultureManagement\Crop\Actions\UpdateCropAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Crop')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Crop $item;
    public $name = '';
    public $field_id = '';
    public $planting_date = '';
    public $status = '';
    public $photo = '';
 
    #[On('field-created')] 
    public function refreshFields($id) { $this->field_id = $id; $this->updatedFieldId($id); }
 
    public function updatedFieldId($value)
    {
        if (!$value) return;
        $related = \App\Models\AgricultureManagement\Field::find($value);
        if (!$related) return;
    }
 
    protected function getfieldsList() {
        return \App\Models\AgricultureManagement\Field::pluck('name', 'id')->toArray();
    }

    public function mount(Crop $crop) { $this->item = $crop; $this->fill($crop->toArray()); $this->planting_date = $crop->planting_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_crops');
        return view('livewire.admin.agriculture-management.crops.edit', [
            'fields' => $this->getfieldsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCropAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/crops', 'uploads'); }
 $dto = CropDTO::fromArray([
            'name' => $this->name,
            'field_id' => $this->field_id,
            'planting_date' => $this->planting_date,
            'status' => $this->status,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('agriculture-management/crops.updated')); return to_route('admin.agriculture-management.crops.index'); }
    protected function rules(): array { return Crop::rules($this->item->id); }
}