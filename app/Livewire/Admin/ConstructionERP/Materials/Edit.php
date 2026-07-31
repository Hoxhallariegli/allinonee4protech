<?php

namespace App\Livewire\Admin\ConstructionERP\Materials;

use App\Models\ConstructionERP\Material;
use App\Domain\ConstructionERP\Material\DTOs\MaterialDTO;
use App\Domain\ConstructionERP\Material\Actions\UpdateMaterialAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Material')]
class Edit extends Component
{
        use WithPagination;
 public Material $item;
    public $name = '';
    public $unit = '';
    public $price = '';
    public $stock = '';
   
    public function mount(Material $material) { $this->item = $material; $this->fill($material->toArray());  }
    public function render() { abort_if_cannot('edit_materials'); return view('livewire.admin.construction-e-r-p.materials.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateMaterialAction $action) { $this->validate();  $dto = MaterialDTO::fromArray([
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/materials.updated')); return to_route('admin.construction-e-r-p.materials.index'); }
    protected function rules(): array { return Material::rules($this->item->id); }
}