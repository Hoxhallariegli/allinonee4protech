<?php

namespace App\Livewire\Admin\RestaurantPOS\DiningTables;

use App\Models\RestaurantPOS\DiningTable;
use App\Domain\RestaurantPOS\DiningTable\DTOs\DiningTableDTO;
use App\Domain\RestaurantPOS\DiningTable\Actions\UpdateDiningTableAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit DiningTable')]
class Edit extends Component
{
        use WithPagination;
 public DiningTable $item;
    public $number = '';
    public $capacity = '';
    public $status = '';
   
    public function mount(DiningTable $diningTable) { $this->item = $diningTable; $this->fill($diningTable->toArray());  }
    public function render() {
        abort_if_cannot('edit_dining_tables');
        return view('livewire.admin.restaurant-p-o-s.dining-tables.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDiningTableAction $action) { $this->validate();  $dto = DiningTableDTO::fromArray([
            'number' => $this->number,
            'capacity' => $this->capacity,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/dining-tables.updated')); return to_route('admin.restaurant-p-o-s.dining-tables.index'); }
    protected function rules(): array { return DiningTable::rules($this->item->id); }
}