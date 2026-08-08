<?php

namespace App\Livewire\Admin\Finance\Categories;

use App\Models\Finance\Category;
use App\Domain\Finance\Category\DTOs\CategoryDTO;
use App\Domain\Finance\Category\Actions\CreateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $type = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.finance.categories.quick-create', [
        ]); }

    public function store(CreateCategoryAction $action)
    {
        $this->validate();
        $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('category-created', id: $item->id);
        $this->js("Livewire.dispatch('category-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/categories.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'type']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Category::rules(); }
}