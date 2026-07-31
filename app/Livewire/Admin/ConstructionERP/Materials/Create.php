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

#[Title('Add Material')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $unit = '';
    public $price = '';
    public $stock = '';
   
    public function render() { abort_if_cannot('add_materials'); return view('livewire.admin.construction-e-r-p.materials.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateMaterialAction $action) { $this->validate();  $dto = MaterialDTO::fromArray([
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/materials.created')); return to_route('admin.construction-e-r-p.materials.index'); }
    protected function rules(): array { return Material::rules(); }
}