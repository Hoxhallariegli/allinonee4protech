<?php

namespace App\Livewire\Admin\AutoRepairManagement\Parts;

use App\Models\AutoRepairManagement\Part;
use App\Domain\AutoRepairManagement\Part\DTOs\PartDTO;
use App\Domain\AutoRepairManagement\Part\Actions\CreatePartAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Part')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $stock = '';
   
    public function render() {
        abort_if_cannot('add_parts');
        return view('livewire.admin.auto-repair-management.parts.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreatePartAction $action) { $this->validate();  $dto = PartDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/parts.created')); return to_route('admin.auto-repair-management.parts.index'); }
    protected function rules(): array { return Part::rules(); }
}