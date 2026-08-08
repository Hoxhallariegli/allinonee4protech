<?php

namespace App\Livewire\Admin\WarehouseManagement\Categories;

use App\Models\WarehouseManagement\Category;
use App\Domain\WarehouseManagement\Category\DTOs\CategoryDTO;
use App\Domain\WarehouseManagement\Category\Actions\UpdateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Category')]
class Edit extends Component
{
        use WithPagination;
 public Category $item;
    public $name = '';
    public $description = '';
   
    public function mount(Category $category) { $this->item = $category; $this->fill($category->toArray());  }
    public function render() {
        abort_if_cannot('edit_categories');
        return view('livewire.admin.warehouse-management.categories.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCategoryAction $action) { $this->validate();  $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'description' => $this->description,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/categories.updated')); return to_route('admin.warehouse-management.categories.index'); }
    protected function rules(): array { return Category::rules($this->item->id); }
}