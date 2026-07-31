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

class QuickCreate extends Component
{
        use WithPagination;
     public $number = '';
    public $capacity = '';
    public $status = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.dining-tables.quick-create', [
        ]); }

    public function store(CreateDiningTableAction $action)
    {
        $this->validate();
        $dto = DiningTableDTO::fromArray([
            'number' => $this->number,
            'capacity' => $this->capacity,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('dining-table-created', id: $item->id);
        $this->js("Livewire.dispatch('dining-table-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/dining-tables.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['number', 'capacity', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return DiningTable::rules(); }
}