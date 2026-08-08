<?php

namespace App\Livewire\Admin\AgricultureManagement\Crops;

use App\Models\AgricultureManagement\Crop;
use App\Domain\AgricultureManagement\Crop\DTOs\CropDTO;
use App\Domain\AgricultureManagement\Crop\Actions\CreateCropAction;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.agriculture-management.crops.quick-create', [
            'fields' => $this->getfieldsList(),
        ]); }

    public function store(CreateCropAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/crops', 'uploads'); }
        $dto = CropDTO::fromArray([
            'name' => $this->name,
            'field_id' => $this->field_id,
            'planting_date' => $this->planting_date,
            'status' => $this->status,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('crop-created', id: $item->id);
        $this->js("Livewire.dispatch('crop-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('agriculture-management/crops.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'field_id', 'planting_date', 'status', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Crop::rules(); }
}