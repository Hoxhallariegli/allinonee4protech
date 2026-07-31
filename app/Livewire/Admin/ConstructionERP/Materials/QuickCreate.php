<?php

namespace App\Livewire\Admin\ConstructionERP\Materials;

use App\Models\ConstructionERP\Material;
use App\Domain\ConstructionERP\Material\DTOs\MaterialDTO;
use App\Domain\ConstructionERP\Material\Actions\CreateMaterialAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $unit = '';
    public $price = '';
    public $stock = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.materials.quick-create', [
        ]); }

    public function store(CreateMaterialAction $action)
    {
        $this->validate();
        $dto = MaterialDTO::fromArray([
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('material-created', id: $item->id);
        $this->js("Livewire.dispatch('material-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/materials.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'unit', 'price', 'stock']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Material::rules(); }
}