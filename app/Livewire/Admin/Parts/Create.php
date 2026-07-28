<?php

namespace App\Livewire\Admin\Parts;

use App\Models\Part;
use App\Domain\Part\DTOs\PartDTO;
use App\Domain\Part\Actions\CreatePartAction;
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
   
    public function render() { abort_if_cannot('add_parts'); return view('livewire.admin.parts.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreatePartAction $action) { $this->validate();  $dto = PartDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($dto); session()->flash('success', __('parts.created')); return to_route('admin.parts.index'); }
    protected function rules(): array { return Part::rules(); }
}