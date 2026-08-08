<?php

namespace App\Livewire\Admin\AutoRepairManagement\Parts;

use App\Models\AutoRepairManagement\Part;
use App\Domain\AutoRepairManagement\Part\DTOs\PartDTO;
use App\Domain\AutoRepairManagement\Part\Actions\UpdatePartAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Part')]
class Edit extends Component
{
        use WithPagination;
 public Part $item;
    public $name = '';
    public $price = '';
    public $stock = '';
   
    public function mount(Part $part) { $this->item = $part; $this->fill($part->toArray());  }
    public function render() {
        abort_if_cannot('edit_parts');
        return view('livewire.admin.auto-repair-management.parts.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePartAction $action) { $this->validate();  $dto = PartDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/parts.updated')); return to_route('admin.auto-repair-management.parts.index'); }
    protected function rules(): array { return Part::rules($this->item->id); }
}