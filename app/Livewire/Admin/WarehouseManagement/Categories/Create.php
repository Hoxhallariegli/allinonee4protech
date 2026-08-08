<?php

namespace App\Livewire\Admin\WarehouseManagement\Categories;

use App\Models\WarehouseManagement\Category;
use App\Domain\WarehouseManagement\Category\DTOs\CategoryDTO;
use App\Domain\WarehouseManagement\Category\Actions\CreateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Category')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $description = '';
   
    public function render() {
        abort_if_cannot('add_categories');
        return view('livewire.admin.warehouse-management.categories.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateCategoryAction $action) { $this->validate();  $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'description' => $this->description,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/categories.created')); return to_route('admin.warehouse-management.categories.index'); }
    protected function rules(): array { return Category::rules(); }
}