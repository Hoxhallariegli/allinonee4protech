<?php

namespace App\Livewire\Admin\RestaurantPOS\DiningTables;

use App\Models\RestaurantPOS\DiningTable;
use App\Domain\RestaurantPOS\DiningTable\DTOs\DiningTableDTO;
use App\Domain\RestaurantPOS\DiningTable\Actions\CreateDiningTableAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add DiningTable')]
class Create extends Component
{
        use WithPagination;
     public $number = '';
    public $capacity = '';
    public $status = '';
   
    public function render() {
        abort_if_cannot('add_dining_tables');
        return view('livewire.admin.restaurant-p-o-s.dining-tables.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDiningTableAction $action) { $this->validate();  $dto = DiningTableDTO::fromArray([
            'number' => $this->number,
            'capacity' => $this->capacity,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/dining-tables.created')); return to_route('admin.restaurant-p-o-s.dining-tables.index'); }
    protected function rules(): array { return DiningTable::rules(); }
}