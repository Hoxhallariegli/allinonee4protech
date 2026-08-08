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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $area_size = '';
    public $soil_type = '';
    public $location_photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.agriculture-management.fields.quick-create', [
        ]); }

    public function store(CreateFieldAction $action)
    {
        $this->validate();
        if ($this->location_photo && !is_string($this->location_photo)) { $this->location_photo = $this->location_photo->store('uploads/fields', 'uploads'); }
        $dto = FieldDTO::fromArray([
            'name' => $this->name,
            'area_size' => $this->area_size,
            'soil_type' => $this->soil_type,
            'location_photo' => $this->location_photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('field-created', id: $item->id);
        $this->js("Livewire.dispatch('field-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('agriculture-management/fields.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'area_size', 'soil_type', 'location_photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Field::rules(); }
}