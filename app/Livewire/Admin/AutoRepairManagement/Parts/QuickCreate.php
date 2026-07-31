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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $stock = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.parts.quick-create', [
        ]); }

    public function store(CreatePartAction $action)
    {
        $this->validate();
        $dto = PartDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('part-created', id: $item->id);
        $this->js("Livewire.dispatch('part-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/parts.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'price', 'stock']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Part::rules(); }
}